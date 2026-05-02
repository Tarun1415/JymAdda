<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymhaiBlog extends Model
{
    use HasFactory;

    protected $table = 'gymhai_blogs';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'city',
        'state',
        'pincode',
        'status',
        'published_at',
        'views',
    ];
}
