<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingTranslation extends Model
{

    protected $table = 'settings_translations';
    public $timestamps = false;
    protected $fillable = array('setting_id', 'title', 'address', 'locale','meta_title','meta_description','meta_keywords');

}
