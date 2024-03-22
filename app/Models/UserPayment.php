<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment_type',
        'provider',
        'account_number',
        'expiry_date',
    ];

    // UserPayment belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
