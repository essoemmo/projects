<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryTranslations extends Model
{

    protected $table = 'categories_translations';
    public $timestamps = false;
    protected $fillable = array('category_id', 'title', 'description', 'locale');

}
