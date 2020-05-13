<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CountriesData extends Model
{
    protected $table = 'countries_data';
    protected $fillable = [
        'title',
        'lang_id',
        'country_id',
        'source_id'
    ];
}
