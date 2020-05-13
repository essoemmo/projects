<?php

namespace App\Models\Article;

use App\Help\HasFiles;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model {

    use HasFiles;
    use Favoriteable;

    protected $table = 'article_category';
    public $timestamps = true;
    protected $fillable = array('store_id', 'published', 'img_url', 'created');

    public function Data() {
        return $this->hasMany(ArticleCategoryData::class, 'category_id', 'id');
    }

   

}
