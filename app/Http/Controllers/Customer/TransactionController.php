<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index() {
        $transactions = Transaction::with('product')->where('user_id', Auth::user()->id)->latest()->get();
        return view('customer.transactions.index', compact('transactions'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'product_id' => ['required', 'exists:products,id'],
            'qty' => ['required', 'integer', 'min:1'],
        ]);

        $product = Product::lockForUpdate()->findOrFail($request->product_id);

        if ($product->stock < $request->qty) {
            return back()->withErrors([
                'qty' => 'Stock tidak mencukupi'
            ]);
        }

        DB::transaction(function () use ($product, $request) {
            $totalPrice = $product->price * $request->qty;

            Transaction::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            $product->decrement('stock', $request->qty);
        });
        
        return redirect()->route('customer.transactions.index')
            ->with('success', 'Transaction created successfully.');
    }

    public function cancel(Transaction $transaction)
    {
        if ($transaction->user_id !== Auth::id()) {
            abort(403);
        }

        if ($transaction->status !== 'pending') {
            return back()->withErrors([
                'status' => 'Only pending transactions can be cancelled.'
            ]);
        }

        DB::transaction(function () use ($transaction) {
            $transaction->product->increment('stock', $transaction->qty);

            $transaction->update([
                'status' => 'cancelled',
            ]);
        });

        return back()->with('success', 'Transaction cancelled.');
    }
}
