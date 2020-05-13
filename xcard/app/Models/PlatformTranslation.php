<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlatformTranslation extends Model
{

    protected $table = 'platforms_translations';
    public $timestamps = true;
    protected $fillable = array('platform_id', 'title', 'locale');

}
