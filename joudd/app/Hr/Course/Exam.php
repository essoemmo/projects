<?php

namespace App\Hr\Course;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';
    public $timestamps = false;
    protected $fillable =[
        'type',
        'type_id',
        'duration',
        'is_active',
        'created',
        'start',
        'end',
    ];

    public function course(){
        return $this->belongsTo('App\Hr\Course\Course','id','type_id');
    }

    public function exam_data(){
        return $this->hasOne(Exam_data::class);
    }
    public function users(){
            $this->belongsToMany(User::class, 'user_exams');
    }
}
