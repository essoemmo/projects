<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model 
{

    protected $table = 'banks';
    public $timestamps = true;
    protected $guarded =[];
    public function bankData()
    {
        return $this->hasMany('App\Models\Bank_data');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

}