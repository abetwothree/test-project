<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];

    // A CartItem belongs to a ShoppingSession
    public function shoppingSession()
    {
        return $this->belongsTo(ShoppingSession::class);
    }

    // A CartItem belongs to a Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
