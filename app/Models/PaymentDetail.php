<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'provider', 'status'];

    // PaymentDetail belongs to OrderDetail
    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class, 'order_id');
    }
}
