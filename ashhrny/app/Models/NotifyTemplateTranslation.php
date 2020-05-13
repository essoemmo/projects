<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifyTemplateTranslation extends Model
{
    protected $table = 'notify_templates_translations';
    protected $fillable = array('title', 'description', 'notify_template_id', 'locale');
}
