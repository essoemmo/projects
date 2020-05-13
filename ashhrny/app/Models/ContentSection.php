<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class ContentSection extends Model
{
    use Translatable;
    protected $table = 'content_sections';
    public $timestamps = true;
    protected $fillable = array('order', 'columns', 'type');
    public $translatedAttributes = [ 'content','title'];

    public function translations()
    {
        return $this->hasMany(ContentSectionTranslation::class, 'content_section_id');
    }

    public function advertisement()
    {
        return $this->belongsToMany(Advertisement::class, 'content_section_advertisement', 'content_section_id');
    }

}
