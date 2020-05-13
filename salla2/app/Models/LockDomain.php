<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LockDomain extends Model
{
    protected $table = 'lock_domain';
      public $timestamps = false;
    protected $fillable = [
        'name'
      
    ];

   
}
