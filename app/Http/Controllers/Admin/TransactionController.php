<?php

namespace App\Http\Controllers\Admin;

use App\Events\TransactionExpired;
use App\Events\TransactionPaid;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                'status' => 'Only awaiting payment transactions can be confirmed.'
            ]);
        }

        if ($transaction->canExpire()) {
            $this->expireTransaction($transaction);

            return back()->with('success', 'Transaction already expired');
        }

        DB::transaction(function () use ($transaction) {
            $transaction->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);

            TransactionPaid::dispatch($transaction);
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
        DB::transaction(function () use ($transaction) {
            $transaction->product->increment('stock', $transaction->qty);

            $transaction->update([
                'status' => 'expired',
            ]);

            TransactionExpired::dispatch($transaction);
        });
    }
}
