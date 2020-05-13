<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank_data extends Model 
{

    protected $table = 'bank_data';
    public $timestamps = true;
    protected $guarded=[];
    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

}