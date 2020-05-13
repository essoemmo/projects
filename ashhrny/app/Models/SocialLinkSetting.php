<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLinkSetting extends Model
{
    protected $table = 'social_link_setting';
    public $timestamps = true;
    protected $fillable = array('setting_id','title','icon','url');

}
