<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $hidden = ['pivot'];
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'shipping_option_id',
        'shipping_cost',
        'total',
        'ordernumber',
        'status',
    ];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function shipping_option(){
        return $this->hasOne('App\Models\Shipping_option','id','shipping_option_id');
    }
    public function shipping(){
        return $this->belongsTo('App\Models\Shipping','order_id','id');
    }
    public function gettransactions(){
        return $this->belongsTo('App\Models\transactions','order_id','id');
    }
    public function order_items(){
        return $this->hasMany('App\Models\OrderItem','order_id','id');
    }
    public function transactions(){
        return $this->belongsToMany('App\Models\transaction_types','transactions','order_id','type_id')->withPivot(
            'status',
            'bank_id',
            'total',
            'currency',
            'discount_code',
            'holder_name',
            'holder_card_number',
            'holder_cvc',
            'holder_expire');
    }
}
