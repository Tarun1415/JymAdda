<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partners\Gym;

class GymReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'gym_id',
        'user_name',
        'rating',
        'review_text',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }
}
