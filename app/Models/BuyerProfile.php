<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'preferred_animal_type',
        'shipping_address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
