<?php


namespace App\Models\Article;


use Illuminate\Database\Eloquent\Model;

class ArticleCategoryData extends Model
{

    protected $table = 'article_category_data';
    protected $fillable = array('category_id', 'lang_id', 'source_id', 'title');
    public $timestamps = true;
}