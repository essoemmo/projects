<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content_section_data extends Model
{

    protected $table = 'content_sections_data';
    protected $guarded =[];
//    protected $casts = [
//        'content' => 'array',
//    ];

    public $timestamps = true;

    public function section()
    {
        return $this->belongsTo(Content_section::class);
    }

}