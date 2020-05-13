<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingAddress extends Model
{
    protected $table = 'shippings_address';
    protected $fillable = [
        'country_id',
        'city_id',
        'order_id',
        'Neighborhood',
        'street',
        'address',
        'code',
    ];
    public function country(){
        return $this->hasOne('App\Models\Country','id','country_id');
    }
    public function city(){
        return $this->hasOne('App\Models\cities','id','city_id');
    }
    public function order(){
        return $this->hasOne('App\Models\orders','id','order_id');
    }
}
