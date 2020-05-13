<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use Translatable;
    protected $table = 'blogs';
    public $translatedAttributes = ['title','content','meta_title','meta_description','meta_keywords'];
    protected $fillable =[
        'image',
        'alt_image',
        'category_id',
        'publish',
    ];

    public function translations(){
        return $this->hasMany('App\Models\BlogTranslation','blog_id','id');
    }

    public function blogTags(){
        return $this->hasMany('App\Models\BlogTags','blog_id','id');
    }
}
