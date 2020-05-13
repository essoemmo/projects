<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model {

    protected $table = 'memberships';
    public $timestamps = true;
    protected $fillable = array('price','duration','currency_code','is_active','created_at');
    protected $with = ['data'];
    public function data() {

        return $this->hasMany(MembershipData::class, 'membership_id', "id");
    }
    public function getData($lang_id) {

        return  MembershipData::where("membership_id", $this->id)->where("lang_id", $lang_id)->first();
       
      
                
    }

//    public function users() {
//        return $this->belongsToMany('App\Models\Membership\User');
//    }

//    public function permissions() {
//        return $this->belongsToMany('App\Models\Membership\Permission');
//    }

}
