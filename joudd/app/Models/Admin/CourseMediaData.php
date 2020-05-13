<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class CourseMediaData extends Model
{
    protected $table = "course_media_data";
    protected $fillable = ['media_id','title','lang_id','source_id','description'];
    public $timestamps = true;


    public function coursemedia(){
        return $this->belongsTo(\App\Hr\Course\CourseMedia::class);
    }

}