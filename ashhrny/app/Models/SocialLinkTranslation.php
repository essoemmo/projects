<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLinkTranslation extends Model
{
    protected $table = 'social_links_translations';
    protected $fillable = array('title' ,'social_id','locale');
    public $timestamps = true;
}
