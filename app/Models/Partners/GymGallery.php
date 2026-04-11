<?php

namespace App\Models\Partners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GymGallery extends Model
{
    use HasFactory;

    protected $table = 'gym_galleries';

    protected $fillable = [
        'gym_id',
        'partner_id',
        'image_path',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'partner_id');
    }
}
