<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social_link extends Model
{

    protected $table = 'social_links';
    public $timestamps = true;
    protected $fillable = array('title', 'url', 'setting_id');

}
