<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class order_products extends Model
{
    use SoftDeletes;
    protected $table = 'order_products';
    protected $fillable = [
        'product_id',
        'order_id',
        'shipping_id',
        'count',
        'comment',
        'price',
        'shipping_cost',
        'attach_url',
        'description',
    ];

    public function product()
    {
        return $this->hasOne('App\Models\product\products', 'id', 'product_id');
    }

    public function order()
    {
        return $this->hasOne('App\Models\product\orders', 'id', 'order_id');
    }
}
