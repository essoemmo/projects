<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class countries extends Model
{
    protected $table = 'countries';
    protected $fillable = [
        'code',
        'logo',
        'tax',
    ];
    protected $with = ['data'];
    public function cities(){
        return $this->hasMany('App\Models\cities','country_id','id');
    }

    public function data(){
        return $this->hasOne('App\CountriesData','country_id');
    }
}
