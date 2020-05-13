<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use Translatable;
    public $translatedAttributes = ['title'];
    protected $table = 'blog_categories';
    protected $fillable = array('main','image');
    public $timestamps = true;


    public function translations()
    {
        return $this->hasMany('App\Models\BlogCategoryTranslation', 'blog_category_id');
    }

}
