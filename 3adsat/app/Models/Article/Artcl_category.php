<?php

namespace App\Models\Article;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Artcl_category extends Model 
{
    use Favoriteable;
    protected $table = 'artcl_categories';
    public $timestamps = true;
    protected $fillable = array('source_id','published', 'lang_id', 'title', 'img_url', 'created');

}