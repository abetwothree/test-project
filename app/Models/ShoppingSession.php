<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingSession extends Model
{
    use HasFactory;
    
    protected $fillable = ['total'];

    // A ShoppingSession belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A ShoppingSession has many CartItems
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
