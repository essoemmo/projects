<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{

    protected $guarded =[];
    protected $table ='files';
    public function fileable(){
        return $this->morphTo();
    }
}
