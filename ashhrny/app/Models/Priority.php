<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use Translatable;
    protected $table = 'priorities';
    public $translatedAttributes = ['title'];

    public function translations(){
        return $this->hasMany('App\Models\PriorityTranslation','priority_id','id');
    }
}
