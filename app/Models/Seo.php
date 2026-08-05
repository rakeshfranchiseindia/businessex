<?php

namespace App\Models;

class Seo extends \Illuminate\Database\Eloquent\Model
{
    protected $table = 'seo';


    protected $fillable = [
        'profile_type',
        'cat_id',
        'title',
        'keyword',
        'description',
        'meta_description',
    ];

}
