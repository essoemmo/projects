<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option_group extends Model
{
    protected $guarded =[];

    public function options(){
        return $this->hasMany(Option::class);
    }
}
