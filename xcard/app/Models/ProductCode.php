<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCode extends Model
{
    protected $table = 'products_codes';
    public $timestamps = false;
    protected $fillable = array('product_id', 'code', 'status');
}
