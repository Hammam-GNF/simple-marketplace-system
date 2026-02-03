<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        return view('admin.transactions.index', [
            'transactions' => Transaction::with(['user', 'product'])->latest()->get(),
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,paid,cancelled',
        ]);

        if ($transaction->status === 'cancelled') {
            return back()->withErrors([
                'status' => 'Cancelled transaction cannot be updated.'
            ]);
        }

        $transaction->update($data);

        return back()->with('success', 'Transaction status updated.');
    }
}
