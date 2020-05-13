<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membership_data_type extends Model 
{

    protected $table = 'membership_data_types';
    protected $guarded=[];
    public $timestamps = true;

    public function membership_type()
    {
        return $this->belongsTo('App\Models\Membership_type');
    }

}