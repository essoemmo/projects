<?php

namespace App\Models\product;

use Illuminate\Database\Eloquent\Model;

class stores extends Model
{
    protected $table = 'stores';
    protected $fillable = [
        'title',
        'domain',
        'image',
        'owner_id',
        'membership_id',
        'lang_id',
        'source_id',
    ];

    public function user(){
        return $this->hasOne('App\Store','id','owner_id');
    }
    public function membership(){
        return $this->hasOne('App\Membership','id','membership_id');
    }
    public function language(){
        return $this->hasOne('App\Models\Language','id','lang_id');
    }
    public function parent(){
        return $this->hasOne('App\Models\product\stores','id','source_id');
    }
    public function products(){
        return $this->hasMany('App\Models\product\products','store_id','id');
    }
    public function languages(){
        return $this->belongsToMany('App\Models\Language','store_languages','store_id','language_id');
    }
}
