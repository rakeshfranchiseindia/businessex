<?php

namespace App\Models;

class StartupImage extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'startup_images';

    protected $primaryKey = 'startup_image_id';

    protected $fillable = [
        'startup_id',
        'type',
        'startup_img_path',
        'startup_img_name',
        'is_active',
    ];


    public function startup()
    {
        return $this->belongsTo(ProfileStartup::class, 'startup_id', 'startup_id');
    }

}
