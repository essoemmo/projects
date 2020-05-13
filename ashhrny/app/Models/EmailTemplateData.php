<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class EmailTemplateData extends Model
{
    use Translatable;
    protected $table = 'email_templates_data';
    public $timestamps = true;
    protected $fillable = array('from_email','email_template_id');
    public $translatedAttributes = ['subject','body','bcc'];

    public function translations()
    {
        return $this->hasMany('App\Models\EmailTemplateDataTranslation','email_template_data_id','id');
    }
}
