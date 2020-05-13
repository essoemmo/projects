<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_login extends Model
{
    protected $guarded =[];

    protected $table = 'user_logins';

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
