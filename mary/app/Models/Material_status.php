<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Material_status extends Model
{
    protected $guarded = [];

    protected $table = 'material_status';

      public function users(){
          return $this->hasMany(User::class);
      }

}
