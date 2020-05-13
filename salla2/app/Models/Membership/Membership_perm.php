<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class Membership_perm extends Model 
{

    protected $table = 'membership_perms';
    public $timestamps = true;
    protected $fillable = array('id','membership_id', 'prm_id');

//    public function permissions()
//    {
//        return $this->belongsToMany(Permission::class);
//    }

    public function memberships()
    {
        return $this->belongsToMany('App\Models\Membership');
    }

}