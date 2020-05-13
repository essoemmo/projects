<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryRegion extends Model
{

    protected $table = 'countries_regions';
    public $timestamps = true;
    protected $fillable = array('country_id', 'region_id');

}
