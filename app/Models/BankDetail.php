<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $table = 'bank_details';

    protected $fillable = [
        'bank',
        'bank_slug',
        'ifsc',
        'ifsc_slug',
        'branch',
        'branch_slug',
        'centre',
        'district',
        'district_slug',
        'state',
        'state_slug',
        'address',
        'contact',
        'imps',
        'rtgs',
        'city',
        'neft',
        'micr',
    ];
}
