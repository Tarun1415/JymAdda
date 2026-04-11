<?php

namespace App\Models\Partners;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Partner extends Model
{
    protected $table = 'partners';
    protected $primaryKey = 'partner_id';

   protected $fillable = [
  'name','email','mobile','state','city','password','token',
  'plan_name','plan_expires_at','gym_limit',
  'partner_image','date_of_birth','address','aadhaar_card',
];

    protected $hidden = ['password', 'token'];

    // ✅ so Carbon comparison works properly
    protected $casts = [
        'plan_expires_at' => 'datetime',
    ];

    public function gyms()
    {
        return $this->hasMany(Gym::class, 'partner_id', 'partner_id');
    }
}
