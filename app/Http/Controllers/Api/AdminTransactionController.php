<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Mail\TransactionCancelledMail;
use App\Mail\TransactionPaidMail;
use App\Models\Transaction;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'product'])->whereNotIn('status', ['cancelled'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return TransactionResource::collection(
            $query->paginate()
        );
    }

    public function confirm(Transaction $transaction)
    {
        if ($transaction->canExpire()) {
            $this->expireTransaction($transaction, 'smtp_live');

            return response()->json([
                'message' => 'Transaction already expired'
            ], 422);
        }

        if (!$transaction->canConfirm()) {
            return response()->json([
                'message' => 'Transaction is not ready for confirmation.'
            ], 422);
        }

        $config = config('mail.mailers.smtp_live');

        if (!$config['host'] || !$config['username']) {
            config(['mail.mailers.smtp_live' => [
                'transport' => 'smtp',
                'host' => 'sandbox.smtp.mailtrap.io',
                'port' => 587,
                'username' => 'c2026ea45c672f',
                'password' => '75351380a09db0',
                'encryption' => 'tls',
            ]]);
        }

        $contextMailer = 'smtp_live';

        DB::transaction(function () use ($transaction, $contextMailer) {
            $transaction->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            Mail::mailer($contextMailer)
                ->to($transaction->user->email)
                ->send(new TransactionPaidMail($transaction));
        });

        return new TransactionResource($transaction->fresh());
    }


    public function invoice(Transaction $transaction, InvoiceService $invoiceService)
    {
        if ($transaction->status !== 'paid') {
            abort(403, 'Invoice only available for paid transactions.');
        }
        
        return $invoiceService
            ->generate($transaction)
            ->download("invoice-{$transaction->id}.pdf");
    }

    private function expireTransaction(Transaction $transaction, string $mailer)
    {
        DB::transaction(function () use ($transaction, $mailer) {
            $transaction->product->increment('stock', $transaction->qty);

            $transaction->update([
                'status' => 'expired',
            ]);

            Mail::mailer($mailer)
                ->to($transaction->user->email)
                ->send(new TransactionCancelledMail($transaction));
        });
    }


}
