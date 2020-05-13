<?php

namespace App\Hr\Course;

use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Model;
use App\Help\HasFiles;
use App\Hr\Course\CourseMedia;
use Illuminate\Support\Facades\App;
use App\User;

class Course extends Model
{
    use Favoriteable;

    use HasFiles;
    protected $table = 'courses';
    protected $appends = ['img_path','video_path'];
    public $timestamps = false;
    protected $fillable = array('title', 'start_date', 'end_date', 'duration', 'cost','description', 'is_active', 'img','in_country','video','user_id','currency_id','lang_id','source_id');
    protected $dirName = 'courses';


    public function getImgPathAttribute()
    {
        return asset('uploads/courses/'.$this->id.'/'.str_replace(' ','%20',$this->img));
    }
 public function getVideoPathAttribute()
    {
        return asset('uploads/courses/'.$this->id.'/'.str_replace(' ','%20',$this->video));
    }

    public function trainers()
    {
        return $this->belongsToMany('App\Hr\Course\Trainer');
    }

    public function co_categories()
    {
        return $this->belongsToMany('App\Hr\Course\Co_category');
    }

    public function applicants()
    {
        return $this->belongsToMany('App\Hr\Course\Applicant');
    }

    public function applicantCourses(){
        return $this->hasMany(ApplicantCourse::class,'course_id','id');
    }

    public function rating(){
        return $this->belongsTo('App\Models\rating\rating','id','course_id');
    }

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }

    public function countries(){
        return $this->belongsToMany('App\Models\Countries','countries_courses','country_id','course_id');
    }

    public function currency(){
        return $this->hasOne('App\Models\Currency','id','currency_id');
    }

    public function coursemedia(){
        return $this->hasMany(CourseMedia::class);
    }

    public function quizz(){
            return $this->hasMany(Exam::class,'type_id');

    }
    public function Userdata(){
        return $this->belongsTo(User::class);
    }
//        public function getTrainerAttribute()
//        {
//           $user = new \App\User();
//            return $this->trainer = $user->getFirstName();
//        }
}
