<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class User_Exam_Answer extends Model
{
    protected $table = 'user_exam_answers';
    public $timestamps = false;
    protected $fillable =[
        'user_exam_id',
        'question_id',
        'answer_id',
        'score',
        'created',
        'is_answer',
    ];
}
