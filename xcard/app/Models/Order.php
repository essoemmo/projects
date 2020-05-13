<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $hidden = ['pivot'];
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'total',
        'orderNumber',
        'status',
        'code_status',
    ];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function getTransactions(){
        return $this->belongsTo('App\Models\Transaction','order_id','id');
    }
    public function order_items(){
        return $this->hasMany('App\Models\OrderItem','order_id','id');
    }
}
