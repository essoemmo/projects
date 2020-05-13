<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'products_categories';
    public $timestamps = false;
    protected $fillable = array('product_id', 'category_id');
}
