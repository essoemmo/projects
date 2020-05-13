<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLinkUser extends Model
{
    protected $table = "social_link_user";
    protected $fillable = ['user_id','social_id','url','default','content'];
    public $timestamps = true;

    public function social()
    {
        return $this->hasOne('App\Models\Social_link', 'id', 'social_id');
    }
}
