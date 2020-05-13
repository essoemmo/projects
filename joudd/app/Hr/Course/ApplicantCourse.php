<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class ApplicantCourse extends Model
{

    protected $table = 'applicant_course';
    public $timestamps = true;
    protected $fillable = array('course_id', 'media_id', 'applicant_id', 'cost', 'amount', 'coupon_id', 'is_paid', 'transaction_id', 'transaction_type');

    public function discountCode(){
        return $this->belongsTo(DiscountCode::class,'coupon_id','id');
    }
    public function applicant(){
        return $this->belongsTo(Applicant::class,'applicant_id','id');
    }
    public function course(){
        return $this->belongsTo(Course::class,'course_id','id');
    }
}
