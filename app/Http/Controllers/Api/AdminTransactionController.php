<?php

namespace App\Http\Controllers\Api;

use App\Events\TransactionExpired;
use App\Events\TransactionPaid;
use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminTransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'product'])
            ->whereNotIn('status', ['cancelled'])
            ->latest();

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
            $this->expireTransaction($transaction);

            return response()->json([
                'message' => 'Transaction already expired'
            ], 422);
        }

        if (! $transaction->canConfirm()) {
            return response()->json([
                'message' => 'Only awaiting payment transactions can be confirmed.'
            ], 422);
        }

        DB::transaction(function () use ($transaction) {
            $transaction->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            TransactionPaid::dispatch($transaction);
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

    private function expireTransaction(Transaction $transaction)
    {
        DB::transaction(function () use ($transaction) {
            $transaction->product->increment('stock', $transaction->qty);

            $transaction->update([
                'status' => 'expired',
            ]);

            TransactionExpired::dispatch($transaction);
        });
    }
}
