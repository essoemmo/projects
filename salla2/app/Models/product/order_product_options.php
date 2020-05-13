<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class order_product_options extends Model
{
    protected $table = 'order_product_options';
    protected $fillable = [
        'order_product_id',
        'option_id',
    ];
}
