<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model 
{

    protected $table = 'transactions';
    public $timestamps = true;

    public function bank()
    {
        return $this->belongsTo('App\Models\Bank');
    }

}