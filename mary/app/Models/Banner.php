<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model 
{

    protected $table = 'banner';
    protected $guarded =[];
    public $timestamps = true;

    public function contentsection()
    {
        return $this->belongsTo('App\Models\Content_section');
    }

    public function bannerData()
    {
        return $this->hasOne('App\Models\Banner_data');
    }

    public function bannerimage(){
        return $this->hasMany(BannerImage::class);
    }

    public function files(){
        return $this->morphMany(File::class,'fileable','fileable_type','fileable_id');
    }

}