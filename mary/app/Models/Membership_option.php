<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership_option extends Model 
{

    protected $table = 'membership_options';
    protected $guarded=[];
    public $timestamps = true;

    public function membership_type()
    {
        return $this->belongsTo('App\Models\Membership_type');
    }

}