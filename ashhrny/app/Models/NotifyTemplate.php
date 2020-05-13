<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class NotifyTemplate extends Model
{
    use Translatable;
    protected $table = 'notify_templates';
    public $timestamps = true;
    protected $fillable = array('code');
    public $translatedAttributes = ['title','description'];

    public function translations()
    {
        return $this->hasMany('App\Models\NotifyTemplateTranslation', 'notify_template_id');
    }
}
