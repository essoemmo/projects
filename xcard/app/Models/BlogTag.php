<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class BlogTag extends Model
{
    protected $table = 'blogs_tags';
    public $timestamps = true;
    protected $fillable = array('tag_id', 'blog_id');

}
