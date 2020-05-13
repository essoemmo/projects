<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Point extends Model
{

    use Translatable;
    protected $table = 'points';
    protected $fillable = array('points_number');
    public $translatedAttributes = ['title','description'];
    public $timestamps = true;


    public function translations()
    {
        return $this->hasMany(PointTranslation::class, 'point_id');
    }
}
