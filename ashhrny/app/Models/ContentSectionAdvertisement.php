<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSectionAdvertisement extends Model
{

    protected $table = 'content_section_advertisement';
    protected $fillable = array('content_section_id', 'advertisement_id' );
    public $timestamps = true;

}
