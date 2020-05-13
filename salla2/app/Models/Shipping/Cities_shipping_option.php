<?php

namespace App\Models\Shipping;

use Illuminate\Database\Eloquent\Model;

class Cities_shipping_option extends Model
{

    protected $table = 'cities_shipping_options';
    public $timestamps = true;
    protected $fillable = array('shipping_option_id', 'city_id');

}