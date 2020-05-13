<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AbandonedCart extends Model
{
    protected $table = "abandoned_carts";
    protected $fillable = [
        'user_id',
        'item_id',
        'qty',
        'total_price',
    ];
}
