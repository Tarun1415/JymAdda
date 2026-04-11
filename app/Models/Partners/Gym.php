<?php

namespace App\Models\Partners;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gym extends Model
{
    use HasFactory;

    protected $table = 'gyms';

    protected $fillable = [
        'uuid',
        'partner_id',
        'gym_limit',
        'gym_name',
        'slug',
        'owner_name',
        'mobile',
        'email',
        'status',
        'description',
        'address',
        'city',
        'state',
        'pincode',
        'trainer_available',
        'parking_available',
        'ac_available',
        'gym_image',
        'opening_time',
        'closing_time',
        'open_days',
        'rating',
        'total_reviews',
        'seo_title',
        'seo_description',
        'seo_keywords',
        'seo_image'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($gym) {
            if (empty($gym->uuid)) {
                $gym->uuid = Str::uuid();
            }
        });
    }

    // Relation with Partner
    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'partner_id');
    }

    // Relation with Galleries
    public function galleries()
    {
        return $this->hasMany(GymGallery::class, 'gym_id', 'id');
    }

    // Relation with Members
    public function members()
    {
        return $this->hasMany(GymMember::class, 'gym_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(\App\Models\Frontend\GymReview::class, 'gym_id', 'id');
    }
}
