<?php

namespace App\Models\Pages;

use Illuminate\Database\Eloquent\Model;

class PageData extends Model
{
    protected $table = 'pages_data';
    protected $fillable = array('page_id', 'lang_id', 'source_id', 'title', 'content');
    public $timestamps = true;
}
