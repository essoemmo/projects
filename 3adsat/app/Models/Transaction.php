<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $fillable =[
        'order_id',
        'type_id',
        'status',
        'bank_id',
        'image',
        'bank_transactions_num',
        'total',
        'image',
        'currency',
        'discount_code',
        'holder_name',
        'holder_card_number',
        'holder_cvc',
        'holder_expire',
    ];
    public function order(){
        return $this->hasOne('App\Models\orders','id','order_id');
    }
    public function type(){
        return $this->hasOne('App\Models\transaction_types','id','type_id');
    }
    public function bank(){
        return $this->hasOne('App\Models\bank_transfer','id','bank_id');
    }
}
