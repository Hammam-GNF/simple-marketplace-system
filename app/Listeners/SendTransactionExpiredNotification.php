<?php

namespace App\Listeners;

use App\Events\TransactionExpired;
use App\Notifications\TransactionExpiredNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTransactionExpiredNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(TransactionExpired $event): void
    {
        $event->transaction
            ->user
            ->notify(new TransactionExpiredNotification($event->transaction));
    }
}

