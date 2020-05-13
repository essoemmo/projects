<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Sphere extends Model
{
    protected $table = 'products_spheres';

    protected $fillable = [
        'product_id',
        'sphere_id',
        'type',
    ];

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }

    public function Sphere()
    {
        return $this->belongsTo('App\Models\Sphere','sphere_id');
    }
}
