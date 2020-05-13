<?php

namespace App\Models\rating;

use Illuminate\Database\Eloquent\Model;

class rating extends Model
{
    protected $table = 'ratings';
    protected $fillable = [
        'course_id',
        'rating',
    ];
    public function users(){
        return $this->belongsToMany('App\User','user_rating','rating_id','user_id')->withPivot('rating','comment');
    }
    public function course(){
        return $this->hasOne('App\Hr\Course\Course','id','course_id');
    }
    public function userRating(){
        return $this->hasMany('App\Models\rating\userRating','rating_id','id');
    }
}
