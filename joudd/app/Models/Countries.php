<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Countries extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'title',
        'code',
        'logo',
        'lang_id',
        'source_id'
    ];
    public function cities(){
        return $this->hasMany('App\Models\cities','country_id','id');
    }

    public function courses(){
        return $this->belongsToMany('App\Hr\Course\Course','countries_courses','course_id','country_id');
    }
}
