<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementTranslation extends Model
{
    protected $table = 'advertisements_translations';
    protected $fillable = array('advertisement_id' ,'title' ,'content','locale');
    public $timestamps = true;
}
