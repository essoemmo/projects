<?php

namespace App\Setting;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model 
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('email', 'phone1' ,'phone2', 'facebook_url', 'youtube_Url', 'twitter_url', 'instagram_url', 'snapchat_url',
        'work_time','close_time','address','store_id','logo');

}