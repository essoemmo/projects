<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletters';
    public $timestamps = true;
    protected $fillable = array('email', 'store_id');
}
