<?php

namespace App\Front;

use App\Help\HasFiles;
use Illuminate\Database\Eloquent\Model;

class News extends Model 
{

    use HasFiles;

    protected $table = 'news';
    protected $dirName = 'News';
    public $timestamps = true;
    protected $fillable = array('category_id', 'title', 'content', 'published', 'created');

    public function category()
    {
        return $this->belongsTo('App\Front\Category', 'category_id');
    }
    public function GetNews()
    {
        return News::select("news.*")->join("categories","categories.id","=","news.category_id")
                ->where('published', '=', 1)
            //    ->where("categories.title" ,"!=" , \App\Model\Utility::$whatWeOffer)
                ;
    }

}