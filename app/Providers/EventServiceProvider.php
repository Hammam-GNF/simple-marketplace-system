<?php

namespace App\Providers;

use App\Events\TransactionExpired;
use App\Events\TransactionPaid;
use App\Listeners\SendTransactionExpiredNotification;
use App\Listeners\SendTransactionPaidNotification;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        TransactionPaid::class => [
            SendTransactionPaidNotification::class,
        ],
        TransactionExpired::class => [
            SendTransactionExpiredNotification::class,
        ],
    ];
}
