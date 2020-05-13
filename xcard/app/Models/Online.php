<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{
    protected $table = 'online_payment';
    public $timestamps = true;
    protected $fillable = array('key');

}
