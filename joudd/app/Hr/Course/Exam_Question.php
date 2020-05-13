<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;
use App\Hr\Course\Question_choice;

class Exam_Question extends Model
{
    protected $table = 'exam_questions';
    protected $fillable =[
        'title',
        'exam_id',
        'score',
        'lang_id',
        'source_id',
    ];
    public function choosen(){
        return $this->hasMany(Question_choice::class,'question_id');
    }
}
