<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner_data extends Model 
{

    protected $table = 'banner_data';
    protected $guarded =[];
    public $timestamps = true;

    public function banner()
    {
        return $this->belongsTo('App\Models\Banner');
    }

}