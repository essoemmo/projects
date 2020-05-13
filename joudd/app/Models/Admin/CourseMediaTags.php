<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class CourseMediaTags extends Model
{
    protected $table = "course_media_tags";
    protected $fillable = ['tag','media_id','url', 'lang_id'];
    public $timestamps = true;
}