<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSetting extends Model
{
    protected $table = 'users_settings';
    public $timestamps = true;
    protected $fillable = array(
        'send_email',
        'send_sms',
        'send_section',
        'normal_user_register',
        'famous_user_register',
        'register_section',
        'famous_section',
        'famous_ads_menu',
        'famous_ads_front',
        'identification_number',
        'identification_image',
        'myAccounts_menu',
        'myAds_menu',
        'featuredAd_menu',
        'AdInOurAccounts_menu',
        'myPoints_menu',
        'ticketOpen_menu',
        'contact_us',
        'points'
    );
}
