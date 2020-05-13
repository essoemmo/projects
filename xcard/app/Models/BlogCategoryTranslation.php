<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoryTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'blog_categories_translations';
    protected $fillable = [
        'blog_category_id',
        'title',
        'locale',
    ];
}
