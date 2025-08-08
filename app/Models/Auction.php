<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    use HasFactory;

    protected $fillable = [
        'animal_id',
        'starting_price',
        'current_bid',
        'start_time',
        'end_time',
        'status'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function highestBid()
    {
        return $this->hasOne(Bid::class)->latest();
    }
}
