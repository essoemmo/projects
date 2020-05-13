<?php

namespace App\Models\Article;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Article extends Model 
{
    use Favoriteable;

    protected $dirName = 'Article';

    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = array('category_id', 'title', 'img_url', 'content', 'published', 'created','lang_id','source_id');

}