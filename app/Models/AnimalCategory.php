<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class AnimalCategory extends Model
{
    use HasFactory;
    // use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'parent_id',
        'depth'
    ];

    public function animals()
    {
        return $this->hasMany(Animal::class);
    }
    // Relationship: A category has many subcategories
    public function children()
    {
        return $this->hasMany(AnimalCategory::class, 'parent_id');
    }

    // Relationship: A subcategory belongs to a parent category
    public function parent()
    {
        return $this->belongsTo(AnimalCategory::class, 'parent_id');
    }

    // Recursive method to get all descendants
    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    // Recursive method to get all ancestors
    public function ancestors()
    {
        return $this->belongsTo(AnimalCategory::class, 'parent_id')->with('ancestors');
    }

    // Check if category has children
    public function hasChildren()
    {
        return $this->children()->count() > 0;
    }

    // Scope to get only root categories (no parent)
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }
}
