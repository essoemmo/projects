<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use Translatable;
    protected $table = 'banks';
    public $translatedAttributes = ['title'];
    protected $fillable =[
        'image',
        'code',
    ];

    public function translations(){
        return $this->hasMany('App\Models\BankTranslation','bank_id','id');
    }
}
