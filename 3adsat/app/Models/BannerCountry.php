<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BannerCountry extends Model
{
    use SoftDeletes;
    protected $table = 'banner_country';

    protected $fillable = [
        'banner_id',
        'country_id',
    ];

    public function countries(){
        return $this->hasOne('App\Models\Country','id','country_id');
    }
    public function banners(){
        return $this->hasOne('App\Models\Banner','id','banner_id');
    }
}
