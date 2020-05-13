<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryTranslations extends Model
{

    protected $table = 'countries_translations';
    public $timestamps = true;
    protected $fillable = array('country_id', 'title', 'locale');

}
