<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageProduct extends Model
{

    protected $table = 'languages_products';
    public $timestamps = true;
    protected $fillable = array('language_id', 'product_id');

}
