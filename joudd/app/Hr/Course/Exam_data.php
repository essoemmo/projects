<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class Exam_data extends Model
{
    protected $table = 'exam_data';
    public $timestamps = false;
    protected $fillable =[
        'title',
        'description',
        'lang_id',
        'exam_id',
    ];

    public function exam(){
        return $this->belongsTo(Exam::class);
    }
}
