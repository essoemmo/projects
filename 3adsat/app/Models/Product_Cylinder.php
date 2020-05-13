<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Cylinder extends Model
{
    protected $table = 'products_cylinder';

    protected $fillable = [
        'product_id',
        'cylinder_id',
        'type',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function cylinder()
    {
        return $this->belongsTo('App\Models\Cylinder');
    }
}
