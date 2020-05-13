<?php


namespace App\Models\Settings;


use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('email', 'logo', 'phone1', 'phone2','facebook_url','instagram_url','twitter_url','youtube_url', 'work_time',
        'address','lang_id','source_id');
}