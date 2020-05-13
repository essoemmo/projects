<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newletters extends Model
{

//    protected $table = 'newletters';
    public $timestamps = true;
    protected $fillable = array('email');
}
