<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTranslation extends Model
{

    protected $table = 'products_translations';
    public $timestamps = true;
    protected $fillable = array('product_id', 'title', 'description', 'System_requirements','locale');

}
