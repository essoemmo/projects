<?php


namespace App\Models;


use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    use Translatable;
    protected $table ="footer";
    protected $fillable = ['url'];
    public $timestamps = true;

    public $translatedAttributes = ['title'];

    public function translations()
    {
        return $this->hasMany(FooterTranslation::class, 'footer_id');
    }


}