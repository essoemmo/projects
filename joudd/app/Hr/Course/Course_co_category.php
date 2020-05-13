<?php

namespace App\Hr\Course;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;

class Course_co_category extends Model
{

    use Favoriteable;

    protected $table = 'co_category_course';
    public $timestamps = true;
    protected $fillable = array('course_id', 'co_category_id');

    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }

}
