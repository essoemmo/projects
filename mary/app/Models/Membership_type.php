<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership_type extends Model 
{

    protected $table = 'membership_types';
    protected $guarded=[];
    public $timestamps = true;

    public function membership_data()
    {
        return $this->hasOne('App\Models\Membership_data_type');
    }

    public function memberOption()
    {
        return $this->hasMany('App\Models\Membership_option');
    }

    public function permissions(){
        return $this->belongsToMany(\Spatie\Permission\Models\Permission::class,'permissions_memberships');
    }


}