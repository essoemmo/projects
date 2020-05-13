<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipping_option extends Model
{

    protected $table = 'shipping_options';
    public $timestamps = true;
    protected $fillable = array('delay', 'cost', 'company_id', 'cash_delivery_commission','country_id', 'source_id','lang_id');
    public function company(){
        return $this->hasOne('App\Models\shippingCompanies','id','company_id');
    }
    public function country(){
        return $this->hasOne('App\Models\countries','id','country_id');
    }
    public function cities(){
        return $this->belongsToMany('App\Models\Cities_shipping_option','cities_shipping_options','shipping_option_id','city_id');
    }
}
