<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';
    protected $primaryKey = 'user_prof_id';

    protected $fillable = [
        'user_id',
        'profile_id',
        'profile_type',
        'profile_str',
        'profile_status',
    ];

    // Relationship: Each profile belongs to one user
    public function user()
    {
        return $this->belongsTo(UserAccount::class, 'user_id', 'user_id');
    }
}
