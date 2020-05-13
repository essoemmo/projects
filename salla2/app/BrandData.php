<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BrandData extends Model
{
    protected $table = 'brands_data';
    protected $fillable = [
        'name',
        'description',
        'lang_id',
        'source_id',
        'brand_id',
    ];
}
