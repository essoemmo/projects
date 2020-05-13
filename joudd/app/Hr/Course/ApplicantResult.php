<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class ApplicantResult extends Model
{
    public function applicant(){
        $this->belongsTo(Applicant::class,'applicant_id','id');
    }
    
}
