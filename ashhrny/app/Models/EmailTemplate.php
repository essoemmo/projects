<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    use Translatable;
    protected $table = 'email_templates';
    public $timestamps = true;
    protected $fillable = array('code');
    public $translatedAttributes = ['title','description'];

    public function translations()
    {
        return $this->hasMany(EmailTemplateTranslation::class, 'email_template_id');
    }
}
