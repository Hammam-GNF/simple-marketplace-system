<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'product'])->where(function ($query) {
            $query->whereNull('expired_at')->orWhere('expired_at', '>', now());
        })->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return view('admin.transactions.index', [
            'transactions' => $query->paginate(10),
            'currentStatus' => $request->status,
        ]);
    }

    public function update(Transaction $transaction)
    {
        if (!$transaction->canConfirm()) {
            return back()->withErrors([
                'status' => 'Transaction is not ready for confirmation.'
            ]);
        }

        DB::transaction(function () use ($transaction) {
            $transaction->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        });

        return back()->with('success', 'Transaction status updated.');
    }
}
