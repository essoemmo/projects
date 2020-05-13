<?php

namespace App\Front;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Favoriteable;

    protected $table = 'co_categories';
    public $timestamps = true;
    protected $fillable = array('title', 'created');

    public function news()
    {
        return $this->hasMany('App\Front\News');
    }

}
