<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class User_membership extends Model 
{

    protected $table = 'user_membership';
    public $timestamps = true;
    protected $fillable = array('id','user_id', 'membership_id', 'price', 'created', 'expire_at');

}