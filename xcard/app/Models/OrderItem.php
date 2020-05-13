<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $fillable = [
        'order_id',
        'type',
        'type_id',
        'count',
        'price',
    ];

    public function product(){
        return $this->hasOne('App\Models\Product','id','type_id');
    }
    public function order(){
        return $this->hasOne('App\Models\Order','id','order_id');
    }
}
