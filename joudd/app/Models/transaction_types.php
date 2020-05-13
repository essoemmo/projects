<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transaction_types extends Model
{
    protected $hidden = ['pivot'];
    public $timestamps = true;
    protected $table = 'transaction_types';
    protected $fillable = [
        'title',
        'code',
        'lang_id',
        'source_id',
    ];
    public function orders(){
        return $this->belongsToMany('App\Models\product\orders','transactions','type_id','order_id')->withPivot(
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
