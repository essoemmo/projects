<?php


namespace App;


use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{

    protected $table = 'transactions';
    protected $fillable =[
        'order_id',
        'type',  // ['delivery', 'bank', 'online']
        'type_id', // transaction type table if => not select bank
        'status', // ['pending', 'paid', 'refused']
        'bank_id',
        'bank_transactions_num',
        'image',
        'total',
        'currency',
        'discount_code',
        'holder_name',
        'holder_card_number',
        'holder_cvc',
        'holder_expire',
        'lang_id',
        'store_id',
        'source_id',
    ];
    public $timestamps = true;
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