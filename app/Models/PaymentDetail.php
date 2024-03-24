<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentDetail extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'provider', 'status'];

    // A PaymentDetail is associated with an OrderDetail
    public function orderDetail()
    {
        return $this->hasOne(OrderDetail::class);
    }
}
