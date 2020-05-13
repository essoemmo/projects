<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;
use App\Hr\Course\Exam_Question;

class Question_choice extends Model
{
    protected $table = 'question_choices';
    protected $fillable =[
        'title',
        'question_id',
        'lang_id',
        'is_answer',
    ];

    public function questions(){
        return $this->belongsTo(Exam_Question::class);
    }
}
