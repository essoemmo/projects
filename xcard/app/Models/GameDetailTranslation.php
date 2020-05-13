<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameDetailTranslation extends Model
{

    protected $table = 'game_details_translations';
    public $timestamps = true;
    protected $fillable = array('game_detail_id', 'title', 'locale');

}
