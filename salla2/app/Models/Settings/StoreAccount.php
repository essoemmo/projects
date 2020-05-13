<?php


namespace App\Models\Settings;


use Illuminate\Database\Eloquent\Model;

class StoreAccount extends  Model
{

    protected $table = 'store_account';
    protected $fillable = array('store_id','is_active', 'created_date','end_date');
    public $timestamps = true;
}