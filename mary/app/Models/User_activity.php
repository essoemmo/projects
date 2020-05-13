<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_activity extends Model
{
    protected $table = 'user_activity';


    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}
