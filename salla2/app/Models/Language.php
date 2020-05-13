<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model 
{
    use SoftDeletes;
    protected $table = 'languages';
    public $timestamps = true;
    protected $fillable = [
        'title',
        'code',
        'flag',
    ];

    public function stores(){
        return $this->belongsToMany('App\Models\product\stores','store_languages','language_id','store_id');
    }

}