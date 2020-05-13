<?php

namespace App\Models\Admin;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class CourseMedia extends Model
{
    use Favoriteable;

    protected $table = "course_media";
    protected $fillable = ['course_id','img','file','cost','is_active','currency_id'];
    public $timestamps = true;

}
