<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    protected $table = 'competition';
    public $timestamps = false;
    protected $fillable = [
        'is_active',
        'title',
        'created',
        'start',
        'end'
    ];
    public function Exam(){

        return $this->hasOne('\App\Hr\Course\Exam','id','exam_id');
    }
}
