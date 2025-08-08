<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupSale extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id',
        'group_name',
        'description',
        'total_price',
        'animal_count'
    ];

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function animals()
    {
        return $this->belongsToMany(Animal::class, 'group_sale_animals');
    }
}
