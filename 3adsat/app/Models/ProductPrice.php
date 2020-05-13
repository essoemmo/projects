<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletes;

class ProductPrice extends Model
{
    //use SoftDeletes;
    protected $table = 'product_price';

    protected $fillable = [
        'product_id',
        'country_id',
        'price',
        'discount',
        'tax_type',
        'tax_rate',
        'quantity',
        'stock_status_id',
        'subtract_stock',
        'size',
        'minimum_order_amount',
    ];

    public function countries(){
        return $this->hasOne('App\Models\Country','id','country_id');
    }
    public function products(){
        return $this->hasOne('App\Models\Product','id','product_id');
    }

}
