<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('title',
        'email',
        'sales_email',
        'contact_email',
        'phone1',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'address',
        'description',
        'logo');

//    protected $guarded = [];

    public function phones() {
        return $this->hasMany('App\Models\SettingCountryPhone','setting_id','id');
    }
}
