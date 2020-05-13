<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class student extends Model
{
    protected $table = 'students';
    protected $fillable = [
        'user_id',
        'education_level',
        'country_id',
    ];
    public function country(){
        return $this->hasOne('App\Models\countries','id','country_id');
    }

    public function user(){
        return $this->hasOne('App\Users','id','user_id');
    }

    public function eduLevel(){
        return $this->hasOne('App\Models\Admin\EducationLevel','id','education_level');
    }
}
