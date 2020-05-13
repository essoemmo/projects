<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAdvertisementUser extends Model
{
    protected $table = 'social_advertisement_user';
    public $timestamps = true;
    protected $fillable = array('orderNumber',
        'user_id',
        'social_link_id',
        'famous_id',
        'account_type_id',
        'advert_type',
        'file',
        'content',
        'price',
        'duration',
        'total',
        'from',
        'to',
    );

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function famous()
    {
        return $this->hasOne('App\User', 'id', 'famous_id');
    }

    public function content_type()
    {
        return $this->hasOne('App\Models\AccountContent', 'id', 'account_type_id');
    }

    public function social_link()
    {
        return $this->hasOne('App\Models\SocialLinkUser', 'id', 'social_link_id');
    }
}
