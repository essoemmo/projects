<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipOptionsMaster extends Model 
{

    protected $table = 'membership_options_master';
    protected $fillable = ['category_id'];
    public $timestamps = true;

    public function Options ()
    {
        return $this->hasMany(\App\MembershipOptionsData::class);
    }
}