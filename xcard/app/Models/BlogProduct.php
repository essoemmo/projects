<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogProduct extends Model
{

    protected $table = 'blogs_products';
    public $timestamps = true;
    protected $fillable = array('blog_id', 'product_id');

}
