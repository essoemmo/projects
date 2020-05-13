<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model 
{

    protected $table = 'Products_Images';
    public $timestamps = true;
    protected $fillable = array('product_id', 'image', 'sort_order');

}