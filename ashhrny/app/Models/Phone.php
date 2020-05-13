<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{

    protected $table = 'phones';
    public $timestamps = true;
    protected $fillable = array('phone', 'phoneable_id', 'phoneable_type');

    public function phoneable()
    {
        return $this->morphTo();
    }

}
