<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Translatable;
    public $translatedAttributes = ['title','description'];
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('parent_id', 'main_menu');

    public function translations()
    {
        return $this->hasMany('App\Models\CategoryTranslations', 'category_id');
    }

}
