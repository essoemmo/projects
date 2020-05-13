<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreData extends Model
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
        'is_active',
    ];

    public function users(){
        return $this->hasOne('App\Store','id','owner_id');
    }
}
