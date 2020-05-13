<?php

namespace App\Models\Article;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;

use App\Help\HasFiles;
use Illuminate\Database\Eloquent\Model;

class Article extends Model 
{

    use HasFiles;
    use Favoriteable;

    protected $dirName = 'Article';

    protected $table = 'articles';
    protected $fillable = array('store_id', 'category_id', 'published', 'img_url', 'created');
    public $timestamps = true;

}