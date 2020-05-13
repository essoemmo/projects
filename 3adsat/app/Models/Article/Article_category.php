<?php

namespace App\Models\Article;

use Illuminate\Database\Eloquent\Model;

class Article_category extends Model 
{

    protected $table = 'article_category';
    public $timestamps = true;
    protected $fillable = array('category_id', 'article_id');

}