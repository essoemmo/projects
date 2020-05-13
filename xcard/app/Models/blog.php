<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use Translatable;
    protected $table = 'blogs';
    public $translatedAttributes = ['title','content'];
    protected $fillable =[
        'image',
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
