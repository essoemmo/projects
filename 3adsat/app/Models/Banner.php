<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'name', 'status', 'sort_order'
    ];       

    /**
    * Get the country record associated with the banner.
    */
    public function countries(){
        return $this->belongsToMany('App\Models\Country','banner_country','banner_id','country_id');
    }

    /**
     * Get the bannerImages for the banner.
     */
    public function bannerImages()
    {
        return $this->hasMany('App\Models\BannerImage');
    }
}
