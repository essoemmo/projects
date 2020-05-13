<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LanguageTranslation extends Model
{

    protected $table = 'languages_translations';
    public $timestamps = true;
    protected $fillable = array('title', 'language_id', 'locale');

}
