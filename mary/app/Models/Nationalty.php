<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nationalty extends Model
{

    protected $guarded=[];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function cities(){
        return $this->hasMany(City::class);
    }


}
