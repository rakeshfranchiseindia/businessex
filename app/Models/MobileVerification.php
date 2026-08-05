<?php

namespace App\Models;

class MobileVerification extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'mobile_verification';

    protected $primaryKey = 'mob_verify_id';

    protected $fillable = [
        'user_id',
        'mobile_no',
        'otp_code',
        'smspg_response',
        'is_verified',
        'verified_at',
    ];

    protected $hidden = [
        'otp_code',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

}
