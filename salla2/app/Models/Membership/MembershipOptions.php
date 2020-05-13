<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipOptions extends Model 
{

    protected $table = 'membership_options';
    protected $fillable = ['membership_id' ,'option_id'];
    public $timestamps = false;

}