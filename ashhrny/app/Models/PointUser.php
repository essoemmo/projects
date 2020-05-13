<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointUser extends Model
{
    protected $table = 'point_user';
    protected $fillable = array('user_id' ,'point_id','point','code');
    public $timestamps = true;
}
