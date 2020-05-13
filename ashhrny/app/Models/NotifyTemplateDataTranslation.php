<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotifyTemplateDataTranslation extends Model
{
    protected $table = 'notify_templates_data_translations';
    public $timestamps = false;
    protected $fillable = array('subject', 'body', 'notify_data_id', 'locale');
}
