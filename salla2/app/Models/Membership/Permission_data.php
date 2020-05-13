<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class Permission_data extends Model 
{

    protected $table = 'permission_data';
    public $timestamps = true;
    protected $fillable = array('lang_id', 'permission_id', 'source_id', 'title');

}