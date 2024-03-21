<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = ['total'];

    // An OrderDetail belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // An OrderDetail has many OrderItems
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // An OrderDetail is associated with a PaymentDetail
    public function paymentDetail()
    {
        return $this->hasOne(PaymentDetail::class);
    }
}
