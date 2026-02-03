<?php

use App\Models\Transaction;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {
    Transaction::with('product')
        ->whereIn('status', ['pending', 'awaiting_payment'])
        ->whereNotNull('expired_at')
        ->where('expired_at', '<', now())
        ->chunkById(50, function ($transactions) {
            foreach ($transactions as $transaction) {
                DB::transaction(function () use ($transaction) {
                    $transaction->product->increment('stock', $transaction->qty);

                    $transaction->update([
                        'status' => 'cancelled',
                    ]);
                });
            }
        });
})->everyMinute()->name('expire-transactions');