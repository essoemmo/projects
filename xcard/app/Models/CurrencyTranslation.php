<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrencyTranslation extends Model
{

    protected $table = 'currencies_translation';
    public $timestamps = true;
    protected $fillable = array('title', 'code', 'currency_id', 'locale');

}
