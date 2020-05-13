<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    public function option_group(){
        return $this->belongsTo(Option_group::class,'group_id');
    }

    public function optionValues(){
        return $this->hasMany(Option_value::class);
    }

    public function users(){
        return $this->belongsToMany(User::class,'user_options');
    }
}
