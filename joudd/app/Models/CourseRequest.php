<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseRequest extends Model
{
    protected $table = 'course_requests';
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'response',
        'lang_id',
        'source_id'
    ];
    public function user(){
        return $this->hasMany('App\User','user_id','id');
    }

}
