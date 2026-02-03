<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        'total_price',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function canCancel()
    {
        return $this->status === 'pending';
    }

    public function canPay()
    {
        return $this->status === 'pending';
    }

    public function canConfirm()
    {
        return $this->status === 'awaiting_payment';
    }
}
