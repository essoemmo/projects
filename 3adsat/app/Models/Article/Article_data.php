<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Article_data extends Model 
{

    protected $table = 'article_data';
    public $timestamps = true;
    protected $fillable = array('source_id', 'lang_id', 'title', 'content', 'created');

}