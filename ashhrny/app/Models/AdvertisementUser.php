<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementUser extends Model
{
    protected $table = 'advertisement_user';
    protected $fillable = array('advertisement_id' ,'user_id','social_link_id','account_content_id','avertisement_type_id',
        'user_name','followers_number','account_link');
    public $timestamps = true;
}
