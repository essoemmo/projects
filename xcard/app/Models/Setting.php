<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    use Translatable;
    public $translatedAttributes = ['title','address','description'];
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('email', 'logo', 'footer_logo', 'work_time');

    public function translations()
    {
        return $this->hasMany('App\Models\SettingTranslation', 'setting_id');
    }

    public function phones()
    {
        return $this->morphMany('App\Models\Phone', 'phoneable', 'phoneable_type', 'phoneable_id');
    }

}
