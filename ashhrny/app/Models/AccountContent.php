<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class AccountContent extends Model
{
    use Translatable;
    protected $table = 'account_contents';
    public $translatedAttributes = ['title'];
    protected $fillable =[];
    public $timestamps = true;

    public function translations(){
        return $this->hasMany(AccountContentTranslation::class ,'account_content_id','id');
    }
}
