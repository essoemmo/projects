<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipData extends Model 
{

    protected $table = 'memberships_data';
    public $timestamps = true;
    protected $fillable = array('id','title','lang_id','membership_id','description','info','source_id','created_at');

//    public function users()
//    {
//        return $this->belongsToMany('App\Models\Membership\User');
//    }
//
//    public function permissions()
//    {
//        return $this->belongsToMany('App\Models\Membership\Permission');
//    }

}