<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class Course_evaluation extends Model 
{

    protected $table = 'course_evaluations';
    public $timestamps = true;
    protected $fillable = array('applicant_id', 'course_id', 'question_id', 'answer');

}