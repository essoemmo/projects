<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class bank_transfer extends Model
{
    protected $table = 'bank_transfers';
    protected $fillable = [
        'title',
        'holder_name',
        'iban',
        'holder_number',
        'logo',
        'store_id',
    ];
    public function store(){
        return $this->hasOne('App\Models\product\stores','id','store_id');
    }
}
