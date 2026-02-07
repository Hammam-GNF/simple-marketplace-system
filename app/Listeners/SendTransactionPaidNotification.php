<?php

namespace App\Listeners;

use App\Events\TransactionPaid;
use App\Notifications\TransactionPaidNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendTransactionPaidNotification implements ShouldQueue
{
    use InteractsWithQueue;
    
    public function handle(TransactionPaid $event): void
    {
        $event->transaction
            ->user
            ->notify(new TransactionPaidNotification($event->transaction));
    }
}

