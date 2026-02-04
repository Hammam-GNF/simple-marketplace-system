<?php

namespace App\Services;

use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceService
{
    /**
     * Create a new class instance.
     */
    public function generate(Transaction $transaction)
    {
        $transaction->load(['user', 'product']);

        return Pdf::loadView('pdf.invoice', [
            'transaction' => $transaction,
        ]);
    }
}
