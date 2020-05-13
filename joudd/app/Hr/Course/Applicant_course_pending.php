<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class Applicant_course_pending extends Model
{

    protected $table = 'applicant_course_pendings';
    public $timestamps = true;
    protected $fillable = array('course_id', 'media_id', 'applicant_id', 'cost', 'amount', 'coupon_id', 'is_paid', 'created', 'transaction_id', 'transaction_type', 'nationality_id');

    public function nationality()
    {
        return $this->hasOne('App\Hr\Nationality');
    }

}
