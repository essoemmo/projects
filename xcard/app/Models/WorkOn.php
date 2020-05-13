<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkOn extends Model
{

    protected $table = 'works_on';
    public $timestamps = true;
    protected $fillable = array('icon', 'title');

}
