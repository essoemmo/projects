<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use Translatable;
    protected $table = 'tags';
    public $timestamps = true;
    public $translatedAttributes = ['title','meta_title','meta_description','meta_keywords'];

    public function translations()
    {
        return $this->hasMany('App\Models\TagTranslation', 'tag_id');
    }

    public function blogTags()
    {
        return $this->hasMany('App\Models\BlogTag', 'tag_id');
    }

}
