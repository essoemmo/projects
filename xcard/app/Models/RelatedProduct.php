<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RelatedProduct extends Model
{

    protected $table = 'related_products';
    public $timestamps = true;
    protected $fillable = array('product_id', 'related_id');

}
