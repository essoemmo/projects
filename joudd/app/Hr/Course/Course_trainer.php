<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class Course_trainer extends Model 
{

    protected $table = 'course_trainer';
    public $timestamps = true;
    protected $fillable = array('course_id', 'trainer_id');

}