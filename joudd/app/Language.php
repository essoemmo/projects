<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';
    public $timestamps = true;
    protected $fillable = [
        'title',
        'code',
        'flag',
    ];

}
