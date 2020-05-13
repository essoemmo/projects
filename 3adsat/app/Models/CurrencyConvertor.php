<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyConvertor extends Model
{
    protected $table = 'currency_convertor';
    protected $fillable = [
        'code',
        'rate',
        'last_update',
        'country_code'
    ];
}
