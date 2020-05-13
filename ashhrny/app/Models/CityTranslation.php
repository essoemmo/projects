<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CityTranslation extends Model
{
    protected $table = 'cities_translations';
    protected $fillable = array('title' ,'city_id' ,'locale');
    public $timestamps = true;
}
