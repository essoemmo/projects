<?php

namespace App\Models\Seo;

use Illuminate\Database\Eloquent\Model;

class SeoTranslation extends Model
{
    protected $table = 'seo_translations';
    protected $fillable = [
        'meta_title',
        'meta_description',
        'seo_id',
        'lang_id',
        'source_id',
    ];
}
