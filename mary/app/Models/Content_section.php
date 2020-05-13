<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content_section extends Model
{

    protected $table = 'content_section';
    protected $guarded =[];
    public $timestamps = true;

    public function banner()
    {
        return $this->hasMany('App\Models\Banner');
    }

    public function content_data()
    {
        return $this->hasMany('App\Models\Content_section_data');
    }

}