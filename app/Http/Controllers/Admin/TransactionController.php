<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TransactionPaidMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'product'])->whereNotIn('status', ['cancelled'])->latest()->paginate(10);

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

        Mail::to($transaction->user->email)->send(new TransactionPaidMail($transaction));

        return back()->with('success', 'Transaction status updated.');
    }
}
