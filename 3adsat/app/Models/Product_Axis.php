<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Axis extends Model
{
    protected $table = 'products_axis';

    protected $fillable = [
        'product_id',
        'axis_id',
        'type',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function Axis()
    {
        return $this->belongsTo('App\Models\Axis');
    }
}
