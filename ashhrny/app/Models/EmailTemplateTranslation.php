<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplateTranslation extends Model
{
    protected $table = 'email_templates_translations';
    protected $fillable = array('title', 'description', 'email_template_id', 'locale');
}
