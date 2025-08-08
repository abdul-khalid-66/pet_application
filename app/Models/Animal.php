<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Animal extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'seller_id',
        'category_id',
        'name',
        'age',
        'date_of_birth',
        'color',
        'weight',
        'height',
        'gender',
        'health_info',
        'feed_details',
        'location',
        'price',
        'sale_type',
        'status',
        'is_featured'
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_featured' => 'boolean'
    ];

    // Relationships
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function category()
    {
        return $this->belongsTo(AnimalCategory::class);
    }

    public function images()
    {
        return $this->hasMany(AnimalImage::class);
    }

    public function auction()
    {
        return $this->hasOne(Auction::class);
    }

    public function groupSales()
    {
        return $this->belongsToMany(GroupSale::class, 'group_sale_animals');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
