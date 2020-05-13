<?php


namespace App\Models\Article;


use Illuminate\Database\Eloquent\Model;

class ArticleData extends Model
{

    protected $table = 'articles_data';
    protected $fillable = array('article_id', 'lang_id', 'source_id', 'title', 'content');
    public $timestamps = true;
}