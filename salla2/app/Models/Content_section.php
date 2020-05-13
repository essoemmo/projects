<?php

namespace App\Models;

use App\Models\product\products;
use App\Models\Settings\Banner;
use Illuminate\Database\Eloquent\Model;

class Content_section extends Model
{

    protected $table = 'content_sections';
    protected $fillable = ['order' ,'columns','type','store_id',"title"];
    protected $guarded =[];
    public $timestamps = true;

    public function content_data()
    {
        return $this->hasMany(Content_section_data::class,'section_id');
    }

    public function contentTitle(){
        return $this->hasOne(Content_section_title::class,'section_id');

    }

    public function products()
    {
        return $this->belongsToMany(products::class, 'content_sections_products', 'content_section_id' ,"product_id");
    }

    public function banners()
    {
        return $this->belongsToMany(Banner::class, 'content_section_banners', 'content_section_id' ,"banner_id");
    }

    public function translations()
    {
        return $this->hasMany(Content_section_title::class, 'section_id');
    }

}