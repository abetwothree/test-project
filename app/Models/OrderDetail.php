<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'payment_id', 'address_id', 'total'];

    // An OrderDetail belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An OrderDetail belongs to an Address
    public function address()
    {
        return $this->belongsTo(UserAddress::class, 'address_id');
    }

    // An OrderDetail has many OrderItems
    /** @return HasMany<OrderItem> */
    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    // An OrderDetail is associated with a PaymentDetail
    public function paymentDetail()
    {
        return $this->belongsTo(PaymentDetail::class, 'payment_id');
    }
}
