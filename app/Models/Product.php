<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'desc', 'sku', 'price'];

    // A Product belongs to a ProductCategory
    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    // A Product belongs to a ProductInventory
    public function inventory()
    {
        return $this->belongsTo(ProductInventory::class);
    }

    // A Product may belong to a Discount
    public function discount()
    {
        return $this->belongsTo(Discount::class);
    }

    // A Product has many OrderItems
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // A Product has many CartItems
    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }
}
