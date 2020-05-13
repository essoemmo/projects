<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipOpttionsData extends Model 
{

    protected $table = 'membership_options_data';
    protected $fillable = ['option_id','title','lang_id'];
    public $timestamps = true;

}