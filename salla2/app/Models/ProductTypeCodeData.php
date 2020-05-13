<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypeCodeData extends Model
{

    protected $table = 'product_types_code_data';
   // public $timestamps = true;
   // protected $fillable = array('id','product_id','created_at');

//    public function product(){
//        return $this->hasOne('App\Models\product\products','product_id','id');
//    }
//    public function data() {
//        return $this->hasOne('App\Models\product\feature_data','feature_id','id');
//    }
//    public function options(){
//        return $this->hasMany('App\Models\product\feature_options','feature_id','id');
//    }
//    public function products(){
//        return $this->belongsToMany('App\Models\product\products','product_features','feature_id','product_id');
//    }
//    public function orders(){
//        return $this->belongsToMany('App\Models\product\orders','order_feature_options','feature_option_id','order_id');
//    }
}
