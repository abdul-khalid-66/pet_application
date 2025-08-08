<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    // use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'profile_image',
        'address',
        'city',
        'country',
        'is_verified'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relationships
    public function sellerProfile()
    {
        return $this->hasOne(SellerProfile::class);
    }

    public function buyerProfile()
    {
        return $this->hasOne(BuyerProfile::class);
    }

    public function animals()
    {
        return $this->hasMany(Animal::class, 'seller_id');
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function ordersAsBuyer()
    {
        return $this->hasMany(Order::class, 'buyer_id');
    }

    public function ordersAsSeller()
    {
        return $this->hasMany(Order::class, 'seller_id');
    }

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function reviewsMade()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'seller_id');
    }

    public function reportsMade()
    {
        return $this->hasMany(Report::class, 'reporter_id');
    }

    public function reportsReceived()
    {
        return $this->hasMany(Report::class, 'reported_user_id');
    }

    public function adminActions()
    {
        return $this->hasMany(AdminAction::class, 'admin_id');
    }

    // Scopes
    public function scopeSellers($query)
    {
        return $query->where('role', 'seller');
    }

    public function scopeBuyers($query)
    {
        return $query->where('role', 'buyer');
    }

    public function scopeAdmins($query)
    {
        return $query->where('role', 'admin');
    }
}
