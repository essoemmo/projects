<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping_type extends Model
{

    protected $table = 'shipping_types';
    public $timestamps = true;
    protected $fillable = array('shipping_option_id', 'no_kg', 'cost_no_kg', 'cost_increase', 'kg_increase');

}
