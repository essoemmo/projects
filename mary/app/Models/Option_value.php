<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Option_value extends Model
{
    protected $guarded =[];

    public function option(){
        return $this->belongsTo(Option::class,'option_id');
    }

    public function userVal(){
        return $this->belongsToMany(User::class,'user_options');
    }
}
