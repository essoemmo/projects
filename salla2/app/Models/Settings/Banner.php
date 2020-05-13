<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{

    protected $table = 'banners';

    protected $fillable = array(
        'sort_order',
        'published',
        'link',
        'image',
        'category_id',
        'store_id',
    );
   

    public function category(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
    public function Data(){
        return $this->hasOne('App\Models\Settings\BannerData','banner_id','id')->first();
    }

}
