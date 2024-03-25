<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];

    // An OrderItem belongs to an OrderDetail
    public function order()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    // An OrderItem belongs to a Product
    /** @return BelongsTo<Product, self> */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
