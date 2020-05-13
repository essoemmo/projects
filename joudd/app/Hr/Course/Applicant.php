<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class Applicant extends  Authenticatable
{
    use Notifiable;
    protected $guard = 'website';

    protected $table = 'applicants';
    public $timestamps = true;
    protected $fillable = array( 'address', 'dob', 'gender','website',
        'personal_id','user_id','country_id','image','grade');

    public function courses()
    {
        return $this->belongsToMany('App\Hr\Course\Course');
    }

    public function applicantResults(){
        return $this->hasMany(ApplicantResult::class,'applicant_id','id');
    }
    public function applicantCourse(){
        return $this->hasMany(ApplicantCourse::class,'applicant_id','id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
