<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteLanguage extends Model
{

    protected $table = 'site_languages';
    public $timestamps = true;
    protected $fillable = array('title', 'flag', 'locale');

}
