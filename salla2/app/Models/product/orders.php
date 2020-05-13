<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class orders extends Model
{
    use SoftDeletes;
    protected $table = 'orders';
    Protected $primaryKey = "id";
    protected $fillable = [
        'user_id',
        'store_id',
        'shipping_option_id',
        'shipping_cost',
        'discount_id',
        'discount',
        'ordernumber',
        'total',
        'status',

    ];

    public function gettransactions()
    {
        return $this->belongsTo('App\Models\product\transactions', 'id', 'order_id');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function shipping_option()
    {
        return $this->hasOne('App\Models\Shipping\Shipping_option', 'id', 'shipping_option_id');
    }

    public function shipping()
    {
        return $this->belongsTo('App\Models\product\Shipping', 'id', 'order_id');
    }


    public function store()
    {
        return $this->hasOne('App\Models\product\stores', 'id', 'store_id');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\Models\product\order_products', 'order_id', 'id');
    }

    public function features()
    {
        return $this->belongsToMany('App\Models\product\features', 'order_feature_options', 'order_id', 'feature_option_id');
    }

    public function transactions()
    {
        return $this->belongsToMany('App\Models\product\transactions', 'transactions', 'order_id', 'type_id')->withPivot(
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
