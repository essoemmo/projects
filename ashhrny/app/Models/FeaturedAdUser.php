<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeaturedAdUser extends Model
{
    protected $table = 'featured_ads_users';
    protected $fillable = array('user_id', 'featured_id', 'featured_type', 'publish', 'price', 'duration', 'total', 'social_link_id', 'from', 'to', 'orderNumber');
    public $timestamps = true;

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function social_link()
    {
        return $this->hasOne('App\Models\SocialLinkUser', 'id', 'social_link_id');
    }
}
