<?php

namespace App\Hr\Course;

use App\Models\Admin\CourseMediaData;
use Illuminate\Database\Eloquent\Model;
use App\Hr\Course\Course;
class CourseMedia extends Model
{

    protected $table = 'course_media';
    public $timestamps = false;
    protected $appends = ['img_path','file_path'];

    public function course(){
        return $this->belongsTo(Course::class);
    }

    public function coursemediadata(){
        return $this->hasOne(CourseMediaData::class,'media_id');
    }

    public function getImgPathAttribute()
    {
        return asset('uploads/courses/'.$this->id.'/'.str_replace(' ','%20',$this->img));
    }
    public function getFilePathAttribute()
    {
        return asset('uploads/courses/'.$this->id.'/'.str_replace(' ','%20',$this->file));
    }


}
