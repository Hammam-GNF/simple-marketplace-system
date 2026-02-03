<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TransactionResource;
use App\Models\Product;
use App\Models\Transaction;
use App\Services\InvoiceService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transactions = $user->transactions()->with('product')->latest()->paginate(10);

        return TransactionResource::collection($transactions);
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $product = Product::lockForUpdate()->findOrFail($request->product_id);

        if ($product->stock < $request->qty) {
            return response()->json([
                'message' => 'Product stock is not enough.'
            ], 422);
        }

        $hasPending = Transaction::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->whereIn('status', ['pending', 'awaiting_payment'])
            ->exists();

        if ($hasPending) {
            return response()->json([
                'message' => 'You have a pending transaction for this product.'
            ], 422);
        }

        $transaction = DB::transaction(function () use ($user, $product, $request) {

            $totalPrice = $product->price * $request->qty;

            $trx = Transaction::create([
                'user_id' => $user->id,
                'product_id' => $product->id,
                'qty' => $request->qty,
                'total_price' => $totalPrice,
                'status' => 'pending',
            ]);

            $product->decrement('stock', $request->qty);

            return $trx;
        });

        return new TransactionResource($transaction);
    }

    public function pay(Transaction $transaction)
    {
        $user = Auth::user();

        if ($transaction->user_id !== $user->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($transaction->canExpire()) {
            $this->expireTransaction($transaction);
            return response()->json([
                'message' => 'Transaction expired'
            ], 422);
        }

        if (!$transaction->canPay()) {
            return response()->json([
                'message' => 'Only pending transactions can be paid.'
            ], 422);
        }

        DB::transaction(function () use ($transaction) {
            $transaction->update([
                'status' => 'awaiting_payment',
                'expired_at' => now()->addDays(3),
            ]);
        });

        return new TransactionResource($transaction->fresh());
    }

    public function cancel(Transaction $transaction)
    {
        $user = Auth::user();

        if ($transaction->user_id !== $user->id) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if (!$transaction->canCancel()) {
            return response()->json([
                'message' => 'Only pending transactions can be canceled.'
            ], 422);
        }

        DB::transaction(function () use ($transaction) {
            $transaction->product->increment('stock', $transaction->qty);

            $transaction->update([
                'status' => 'canceled',
            ]);
        });

        return response()->json([
            'message' => 'Transaction cancelled'
        ]);
    }

    public function invoice(Transaction $transaction, InvoiceService $invoiceService)
    {
        if ($transaction->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        if ($transaction->status !== 'paid') {
            return response()->json([
                'message' => 'Invoice can only be generated for paid transactions.'
            ], 400);
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
        });
    }

}
