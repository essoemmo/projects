<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class CourseComments extends Model
{

    protected $table = "course_comments";
    protected $fillable = ['name','email','course_id','message' ,'approve'];
    public $timestamps = true;
}