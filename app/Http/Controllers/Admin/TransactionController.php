<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TransactionCancelledMail;
use App\Mail\TransactionPaidMail;
use App\Models\Transaction;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'product'])->whereNotIn('status', ['cancelled'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return view('admin.transactions.index', [
            'transactions' => $query->paginate(10),
            'currentStatus' => $request->status,
        ]);
    }

    public function show(Transaction $transaction)
    {
        return view('admin.transactions.show', [
            'transaction' => $transaction->load(['user', 'product']),
        ]);
    }

    public function update(Transaction $transaction)
    {
        if (!$transaction->canConfirm()) {
            return back()->withErrors([
                'status' => 'Transaction is not ready for confirmation.'
            ]);
        }

        $config = config('mail.mailers.smtp_sandbox');

        if (!$config['host'] || !$config['username']) {
            config(['mail.mailers.smtp_sandbox' => [
                'transport' => 'smtp',
                'host' => 'sandbox.smtp.mailtrap.io',
                'port' => 2525,
                'username' => 'c2026ea45c672f',
                'password' => '75351380a09db0',
                'encryption' => 'tls',
            ]]);
        }

        $contextMailer = 'smtp_sandbox';

        DB::transaction(function () use ($transaction, $contextMailer) {
            $transaction->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            Mail::mailer($contextMailer)
                ->to($transaction->user->email)
                ->send(new TransactionPaidMail($transaction));
        });


        return back()->with('success', 'Transaction status updated.');
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

    private function expireTransaction(Transaction $transaction)
    {
        $contextMailer = 'smtp_sandbox';

        DB::transaction(function () use ($transaction, $contextMailer) {
            $transaction->product->increment('stock', $transaction->qty);

            $transaction->update([
                'status' => 'expired',
            ]);

            Mail::mailer($contextMailer)
                ->to($transaction->user->email)
                ->send(new TransactionCancelledMail($transaction));
        });
    }
}
