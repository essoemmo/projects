<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    use Translatable;

    protected $table = 'platforms';
    public $timestamps = true;
    protected $fillable = array('image');

    public $translatedAttributes = ['title'];


    public function translations()
    {
        return $this->hasMany(PlatformTranslation::class, 'platform_id');
    }
}
