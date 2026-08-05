<?php

namespace App\Models;

class BusinessImage extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'business_images';

    protected $primaryKey = 'business_image_id';

    protected $fillable = [
        'business_id',
        'type',
        'business_img_path',
        'business_img_name',
        'is_active',
    ];


    public function business()
    {
        return $this->belongsTo(ProfileBusiness::class, 'business_id', 'business_id');
    }

}
