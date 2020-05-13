<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannerData extends Model
{
    protected $table = 'banners_data';
    protected $fillable = [
        'name',
        'description',
        'lang_id',
        'source_id',
        'banner_id',
    ];
}
