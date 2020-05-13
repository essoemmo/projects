<?php

namespace App\Hr\Course;

use App\Models\Countries;
use Illuminate\Database\Eloquent\Model;

class Countries_Courses extends Model
{
    protected $table = 'countries_courses';
    public $timestamps = true;
    protected $fillable = array('course_id', 'country_id');

    public function courses(){
        return $this->hasOne('App\Hr\Course\Course','id','course_id');
    }
    public function countries(){
        return $this->hasOne('App\Models\Countries','id','country_id');
    }
}
