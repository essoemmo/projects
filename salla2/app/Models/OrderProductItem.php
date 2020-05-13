<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderProductItem extends Model
{
    protected $table = 'order_product_items';
    protected $fillable = [
        'order_product_id',
        'item_id',
        'product_type_code',
    ];
}
