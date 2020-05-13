<?php

namespace App\Models\settings;

use Illuminate\Database\Eloquent\Model;

class StoreOption extends Model
{
    protected $table = "store_options";
    protected $fillable = [
        'order_accept',
        'product_rating',
        'product_outStock',
        'discount_codes',
        'product_purchases_count',
        'similar_products',
        'store_id'
    ];
}
