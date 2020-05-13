<?php

namespace App\Hr\Course;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{

    protected $table = 'trainers';
    public $timestamps = true;
    protected $fillable = array('skills','gender','created_at','user_id','country_id','address','department','degree','image');

    public function courses()
    {
        return $this->belongsToMany('App\Hr\Course\Course');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

}
