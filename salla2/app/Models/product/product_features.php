<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class product_features extends Model
{
    protected $table = 'product_features';
    public $timestamps = true;
    protected $fillable = array('product_id', 'feature_id');
}
