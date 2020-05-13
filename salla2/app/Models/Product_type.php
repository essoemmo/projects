<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_type extends Model 
{

    protected $table = 'product_types';
    public $timestamps = true;
    protected $fillable = array('id', 'store_id','type_code','created_at');

    public function product(){
        $this->hasMany('App\Models\product\products','product_type','id');
    }
    public function Code()
    {
         return $this->hasMany('App\Models\ProductTypeCode', 'id', 'type_code');
    }
}