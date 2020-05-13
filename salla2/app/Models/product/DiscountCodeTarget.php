<?php


namespace App\Models\product;


use Illuminate\Database\Eloquent\Model;

class DiscountCodeTarget extends Model
{

    protected $table = 'discount_codes_target';
    protected $fillable = array('discount_id','item_id','model_type');
    //'model_type' =>  ["products","category"]
    public $timestamps = true;
}