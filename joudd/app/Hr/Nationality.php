<?php

namespace App\Hr;

use Illuminate\Database\Eloquent\Model;

class Nationality extends Model 
{

    protected $table = 'nationalities';
    public $timestamps = true;
    protected $fillable = array('country_code', 'country_name');

}