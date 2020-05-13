<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use App\Models\GameDetailTranslation;

class GameDetail extends Model
{
    use Translatable;

    protected $table = 'game_details';
    public $timestamps = true;
    protected $fillable = array('image');


    public $translatedAttributes = ['title'];

    public function translations()
    {
        return $this->hasMany(GameDetailTranslation::class, 'game_detail_id');
    }

}
