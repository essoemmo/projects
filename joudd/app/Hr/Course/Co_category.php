<?php

namespace App\Hr\Course;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Co_category extends Model 
{
    use Favoriteable;
    protected $table = 'co_categories';
    public $timestamps = true;
    protected $fillable = array('id','cat_name','parent_id' ,'lang_id','source_id');

    public function courses()
    {
        return $this->belongsToMany('App\Hr\Course\Course');
    }

}