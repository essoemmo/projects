<?php

namespace App\Models\Shipping;

use Illuminate\Database\Eloquent\Model;

class Shipping_type extends Model 
{

    protected $table = 'shipping_types';
    public $timestamps = true;
    protected $fillable = array('shipping_option_id', 'no_kg', 'cost_no_kg', 'cost_increase', 'kg_increase', 'store_id');
    public function shippingOptions(){
        return $this->hasOne('App\Models\Shipping\Shipping_option','id','shipping_option_id');
    }
}