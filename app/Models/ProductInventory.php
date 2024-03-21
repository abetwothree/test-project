<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInventory extends Model
{
    use HasFactory;

    protected $fillable = ['quantity'];

    // ProductInventory has one or many Products
    public function products()
    {
        return $this->hasMany(Product::class, 'inventory_id');
    }
}
