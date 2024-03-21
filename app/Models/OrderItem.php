<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
