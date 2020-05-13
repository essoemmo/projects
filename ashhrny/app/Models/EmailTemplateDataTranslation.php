<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateDataTranslation extends Model
{
    protected $table = 'email_templates_data_translations';
    public $timestamps = false;
    protected $fillable = array('subject', 'body', 'email_template_data_id', 'locale');
}
