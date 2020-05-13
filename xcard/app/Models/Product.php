<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Translatable;
    public $translatedAttributes = ['title','description','System_requirements'];
    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = array('main_image', 'quantity', 'price','video', 'release_date', 'developers', 'publishers', 'works_on_id', 'platform_id', 'region_id');

    public function translations()
    {
        return $this->hasMany('App\Models\ProductTranslation', 'product_id');
    }

    public function files()
    {
        return $this->morphMany('App\Models\files', 'fileable','fileable_type','fileable_id');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category','products_categories','product_id','category_id');
    }

    public function languages(){
        return $this->belongsToMany('App\Models\Languages','languages_products','product_id','language_id');
    }

    public function details(){
        return $this->belongsToMany('App\Models\GameDetail','gamedetails_products','product_id','game_detail_id');
    }

    public function genres(){
        return $this->belongsToMany('App\Models\Genre','genres_products','product_id','genre_id');
    }

    public function codes()
    {
        return $this->hasMany('App\Models\ProductCode', 'product_id');
    }

    public function region() {
        return $this->hasOne('App\Models\Region', 'id', 'region_id');
    }

    public function platform() {
        return $this->hasOne('App\Models\Platform', 'id', 'region_id');
    }

    public function workOn() {
        return $this->hasOne('App\Models\WorkOn', 'id', 'works_on_id');
    }

}
