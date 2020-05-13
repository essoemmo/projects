<?php


namespace App\Models\Front;


use Illuminate\Database\Eloquent\Model;

class CurrencyConvertor extends Model
{
    protected $table = 'currency_convertor';
    public $timestamps = true;
    protected $fillable = array('code', 'rate' ,'last_update');

}