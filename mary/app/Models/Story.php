<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Story extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function storyData(){
        return $this->hasMany(Story_data::class);
    }
}
