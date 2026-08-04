<?php

namespace App\Models;

class User extends \Illuminate\Database\Eloquent\Model
{
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
        'verify_token',
        'contact_response',
        'contact_status',
        'last_notify_at',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'verify_token',
    ];

    protected $casts = [
        'last_notify_at' => 'datetime',
        'last_login_at' => 'datetime',
    ];


    public function profiles()
    {
        return $this->hasMany(UserProfile::class, 'user_id', 'user_id');
    }

    public function businessProfiles()
    {
        return $this->hasMany(ProfileBusiness::class, 'user_id', 'user_id');
    }

    public function investorProfiles()
    {
        return $this->hasMany(ProfileInvestor::class, 'user_id', 'user_id');
    }

    public function startupProfiles()
    {
        return $this->hasMany(ProfileStartup::class, 'user_id', 'user_id');
    }

    public function mentorProfiles()
    {
        return $this->hasMany(ProfileMentor::class, 'user_id', 'user_id');
    }

    public function lenderProfiles()
    {
        return $this->hasMany(ProfileLender::class, 'user_id', 'user_id');
    }

    public function brokerProfiles()
    {
        return $this->hasMany(ProfileBroker::class, 'user_id', 'user_id');
    }

    public function incubatorProfiles()
    {
        return $this->hasMany(ProfileIncubator::class, 'user_id', 'user_id');
    }

    public function memberships()
    {
        return $this->hasMany(ProfileMembership::class, 'user_id', 'user_id');
    }

    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'user_id', 'user_id');
    }

    public function businessBookmarks()
    {
        return $this->hasMany(BusinessBookmark::class, 'user_id', 'user_id');
    }

    public function onlinePayments()
    {
        return $this->hasMany(OnlinePayment::class, 'user_id', 'user_id');
    }

    public function newsletterSubscriptions()
    {
        return $this->hasMany(BusinessexNewsletter::class, 'user_id', 'user_id');
    }

    public function mobileVerifications()
    {
        return $this->hasMany(MobileVerification::class, 'user_id', 'user_id');
    }

    public function profileVisitors()
    {
        return $this->hasMany(ProfileVisitor::class, 'user_id', 'user_id');
    }

    public function sentContactRequests()
    {
        return $this->hasMany(RequestContact::class, 'sender', 'user_id');
    }

    public function receivedContactRequests()
    {
        return $this->hasMany(RequestContact::class, 'receiver', 'user_id');
    }

}
