<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PriorityTranslation extends Model
{
    protected $table = 'priorities_translations';
    public $timestamps = false;
    protected $fillable = array('priority_id', 'title', 'locale');
}
