<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'farm_name',
        'bio',
        'document_type',
        'document_number',
        'document_image',
        'is_approved'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
