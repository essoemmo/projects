<?php

namespace App;

use App\Models\product\stores;
use Illuminate\Database\Eloquent\Model;

class Celebrate extends Model
{
    protected $guarded =[];


    public function store(){
        return $this->belongsTo(stores::class);
    }
}
