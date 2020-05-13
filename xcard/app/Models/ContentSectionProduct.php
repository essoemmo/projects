<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSectionProduct extends Model
{

    protected $table = 'content_sections_products';
    public $timestamps = true;
    protected $fillable = array('content_section_id', 'product_id');

}
