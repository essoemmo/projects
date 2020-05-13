<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class User_Exam extends Model
{
    protected $table = 'user_exams';
    public $timestamps = false;
    protected $fillable =[
        'user_id',
        'exam_id',
        'score',
        'created',
    ];


}
