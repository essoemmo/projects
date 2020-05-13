<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    use Translatable;
    public $translatedAttributes = ['title', 'total_title', 'warning_description', 'meta_title', 'meta_description', 'meta_keywords'];
    protected $table = 'settings';
    public $timestamps = true;
    protected $fillable = array('email', 'report_email', 'logo', 'footer_logo', 'work_time', 'alt_logo', 'alt_footer_logo');

    public function translations()
    {
        return $this->hasMany('App\Models\SettingTranslation', 'setting_id');
    }

    public function phones()
    {
        return $this->morphMany('App\Models\Phone', 'phoneable', 'phoneable_type', 'phoneable_id');
    }

}
