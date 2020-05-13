<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionTranslation extends Model 
{

    protected $table = 'regions_translations';
    public $timestamps = true;
    protected $fillable = array('region_id', 'title', 'locale');

}