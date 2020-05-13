<?php


namespace App\Models\product;


use Illuminate\Database\Eloquent\Model;

class DiscountCodeItems extends Model
{

    protected $table = 'discount_codes_items';
    protected $fillable = array('discount_id','type','include_all','item_id');
    // 'type' , ['category','product','user_group']
    public $timestamps = true;
}