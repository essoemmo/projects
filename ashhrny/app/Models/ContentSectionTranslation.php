<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentSectionTranslation extends Model
{

    protected $table = 'content_sections_translations';
    public $timestamps = true;
    protected $fillable = array('content_section_id', 'title','content', 'locale');

}
