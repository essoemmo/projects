<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    protected $table = 'transactions';
    protected $fillable =[
        'order_id',
        'type_id', // transaction type table if => not select bank
        'status',
        'bank_id',
        'transaction_no',
       // 'image',
        //'bank_transactions_num',
        'total',
        'currency_id',
        //'discount_code',
        'holder_name',
        'holder_card_number',
        'holder_cvc',
        'holder_expire',
    ];
    public function order(){
        return $this->hasOne('App\Models\product\orders','id','order_id');
    }
    public function type(){
        return $this->hasOne('App\Models\product\transaction_types','id','type_id');
    }
    public function bank(){
        return $this->hasOne('App\Models\product\bank_transfer','id','bank_id');
    }
}
