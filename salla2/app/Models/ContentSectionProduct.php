<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSectionProduct extends Model
{

    protected $table = 'content_sections_products';
    protected $fillable = array('content_section_id', 'product_id');
    public $timestamps = true;

}
