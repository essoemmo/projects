<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ContentSectionProduct extends Model
{
    protected  $table = "content_sections_products";
    public $timestamps = false;
    protected $fillable = [
        'product_id',
        'section_id'
    ];
}
