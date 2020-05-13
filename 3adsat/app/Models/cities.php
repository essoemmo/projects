<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cities extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'title',
        'country_id',
        'lang_id',
        'source_id'
    ];
    public function country(){
        return $this->hasOne('App\Models\countries','id','country_id');
    }

    public function shipping_option(){
        return $this->belongsToMany('App\Models\Shipping\Cities_shipping_option','cities_shipping_options','city_id','shipping_option_id');
    }
}
