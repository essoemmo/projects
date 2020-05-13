<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointTranslation extends Model
{
    protected $table = 'points_translations';
    protected $fillable = array('point_id' ,'title','description','locale');
    public $timestamps = true;
}
