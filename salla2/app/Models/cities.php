<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'country_id',
    ];
    public function country(){
        return $this->hasOne('App\Models\countries','id','country_id');
    }

    public function shipping_option(){
        return $this->belongsToMany('App\Models\Shipping\Shipping_option','cities_shipping_options','city_id','shipping_option_id');
    }

    public function data(){
        return $this->hasOne(CityData::class,'city_id');

    }
}
