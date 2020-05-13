<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class membershipUser extends Model
{
    protected $table = 'user_membership';
    protected $with = ['user'];
    protected $fillable = [
        'user_id',
        'membership_id',
        'price',
        'created',
        'expire_at',
    ];

    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function membership(){
        return $this->hasOne('App\membership','id','membership_id');
    }
}
