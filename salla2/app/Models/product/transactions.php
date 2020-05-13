<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class transactions extends Model
{
    use SoftDeletes;
    protected $table = 'transactions';
    protected $fillable = [
        'order_id',
        'type_id',
        'type',
        'store_id',
        'status',
        'bank_id',
        'total',
        'currency',
        'discount_code',
        'holder_name',
        'holder_card_number',
        'holder_cvc',
        'holder_expire',
        'bank_transactions_num',
        'image',
    ];

    public function order()
    {
        return $this->hasOne('App\Models\product\orders', 'id', 'order_id');
    }

    public function transaction_type()
    {
        return $this->hasOne('App\Models\product\transaction_types', 'id', 'type_id');
    }

    public function bank()
    {
        return $this->hasOne('App\Models\product\bank_transfer', 'id', 'bank_id');
    }
}
