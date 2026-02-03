<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'product'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        return view('admin.transactions.index', [
            'transactions' => $query->paginate(10),
            'currentStatus' => $request->status,
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
