<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'password',
        'telephone',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships

    // A User has many UserAddresses
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }

    // A User has many OrderDetails
    public function orders()
    {
        return $this->hasMany(OrderDetail::class);
    }

    // A User has many UserPayments
    public function payments()
    {
        return $this->hasMany(UserPayment::class);
    }

    // A User has many ShoppingSessions
    public function shoppingSessions()
    {
        return $this->hasMany(ShoppingSession::class);
    }
    
}
