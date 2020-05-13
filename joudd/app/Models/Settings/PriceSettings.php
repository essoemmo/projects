<?php


namespace App\Models\Settings;


use Illuminate\Database\Eloquent\Model;

class PriceSettings extends Model
{

    protected $table = 'price_settings';
    public $timestamps = true;
    protected $fillable = array('price' , 'type');
}