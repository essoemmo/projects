<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{

    protected $table = 'newsletters';
    public $timestamps = true;
    protected $fillable = array('email');

}