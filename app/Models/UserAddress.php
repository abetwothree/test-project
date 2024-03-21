<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'address_line1',
        'address_line2',
        'city',
        'state',
        'postal_code',
        'country',
        'telephone',
        'mobile',
    ];

    // UserAddress belongs to User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
