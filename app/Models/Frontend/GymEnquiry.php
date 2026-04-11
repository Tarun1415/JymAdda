<?php

namespace App\Models\Frontend;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Partners\Gym;

class GymEnquiry extends Model
{
    use HasFactory;

    protected $table = 'gym_enquiries';

    protected $fillable = [
        'gym_id',
        'name',
        'mobile',
        'message',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id', 'id');
    }
}
