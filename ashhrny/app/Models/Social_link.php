<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Social_link extends Model
{
    use Translatable;
    protected $table = 'social_links';
    protected $fillable = array('icon');
    public $translatedAttributes = ['title'];
    public $timestamps = true;

    public function translations()
    {
        return $this->hasMany(SocialLinkTranslation::class, 'social_id');
    }

}
