<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'blog_translations';
    protected $fillable = [
        'blog_id',
        'title',
        'locale',
        'content',
    ];
}
