<?php

namespace App\Models\Partners;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class GymMember extends Model
{
    use HasFactory;

    protected $table = 'gym_members';

    protected $fillable = [
        'uuid',
        'gym_id',
        'partner_id',
        'member_id',
        'name',
        'mobile',
        'address',
        'adhar_no',
        'plan_duration',
        'start_date',
        'end_date',
        'total_fees',
        'amount_paid',
        'pending_amount',
        'status',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class, 'gym_id', 'id');
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class, 'partner_id', 'partner_id');
    }

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Auto generate member ID on create
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($member) {
            $member->uuid = Str::uuid()->toString();
            $member->pending_amount = max(0, $member->total_fees - $member->amount_paid);

            if (empty($member->member_id)) {
                $latest = self::latest('id')->first();
                $nextId = $latest ? $latest->id + 1 : 1;
                $member->member_id = 'JYM-' . str_pad($nextId, 4, '0', STR_PAD_LEFT);
            }
        });

        static::updating(function ($member) {
            $member->pending_amount = max(0, $member->total_fees - $member->amount_paid);
        });
    }
}
