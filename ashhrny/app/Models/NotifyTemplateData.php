<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class NotifyTemplateData extends Model
{
    use Translatable;
    protected $table = 'notify_templates_data';
    public $timestamps = true;
    protected $fillable = array('notify_template_id');
    public $translatedAttributes = ['subject','body','bcc'];

    public function translations()
    {
        return $this->hasMany('App\Models\NotifyTemplateDataTranslation','notify_data_id','id');
    }
}
