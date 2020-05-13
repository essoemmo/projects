<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';

    public $timestamps = false;

    public function catArt(){
        return $this->belongsTo(Artcl_category::class,'category_id');
    }
}
