<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artcl_category extends Model
{
//    public $timestamps = false;

public function articels(){
    return $this->hasMany(Article::class);
}


}
