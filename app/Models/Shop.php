<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Shop extends Model
{
    protected $table = 'shops';

    protected $fillable = [
        'name',
    ];

    public function products() :BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'shop_product')->withPivot('description')->withTimestamps();
    }
}
