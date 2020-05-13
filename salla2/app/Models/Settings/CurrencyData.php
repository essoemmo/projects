<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;

class CurrencyData extends Model
{
    protected $table = 'currency_data';
    protected $fillable =[
        'title',
        'currency_id',
        'lang_id',
        'source_id',
    ];
}
