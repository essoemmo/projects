<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagTranslation extends Model
{
    public $timestamps = false;
    protected $table = 'tag_translations';
    protected $fillable = [
        'tag_id',
        'title',
        'locale',
    ];
}
