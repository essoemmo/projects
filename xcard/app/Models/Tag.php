<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'tags';
    public $timestamps = true;

    public function translations()
    {
        return $this->hasMany('App\Models\TagTranslation', 'tag_id');
    }

    public function blogTags()
    {
        return $this->hasMany('App\Models\BlogTag', 'tag_id');
    }

}
