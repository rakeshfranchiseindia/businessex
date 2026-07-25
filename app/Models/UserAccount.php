<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class UserAccount extends Authenticatable
{
    use Notifiable;

    protected $table = 'user_account';
    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_rand_id',
        'name',
        'email',
        'password',
        'mobile',
        'location',
        'timezone',
        'company_name',
        'designation',
        'is_active',
        'reg_source',
        'reg_profile',
        'linkedin_id',
        'google_id',
        'facebook_id',
        'profile_pic',
        'remember_token',
        'verify_token',
        'contact_response',
        'contact_status',
        'last_notify_at',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'verify_token',
    ];

    // Relationship: One user can have many profiles
    public function profiles()
    {
        return $this->hasMany(UserProfile::class, 'user_id', 'user_id');
    }
}
