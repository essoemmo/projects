<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankTranslation extends Model
{
    protected $table = 'banks_translations';
    public $timestamps = false;
    protected $fillable = array('bank_id', 'title', 'locale');
}
