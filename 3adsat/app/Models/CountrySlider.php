<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CountrySlider extends Model
{
    use SoftDeletes;
    protected $table = 'country_slider';

    protected $fillable = [
        'slider_id',
        'country_id',
    ];

    public function countries(){
        return $this->hasOne('App\Models\Country','id','country_id');
    }
    public function sliders(){
        return $this->hasOne('App\Models\Slider','id','slider_id');
    }
}
