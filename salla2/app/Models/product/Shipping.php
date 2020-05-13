<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
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
        return $this->hasOne('App\Models\countries','id','country_id');
    }
    public function city(){
        return $this->hasOne('App\Models\cities','id','city_id');
    }
    public function order(){
        return $this->hasOne('App\Models\product\orders','id','order_id');
    }
}
