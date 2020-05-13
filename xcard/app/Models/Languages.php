<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Languages extends Model
{

    use Translatable;
    protected $table = 'languages';
    public $timestamps = true;

    public $translatedAttributes = ['title'];


    public function translations()
    {
        return $this->hasMany(LanguageTranslation::class, 'language_id');
    }

}
