<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Content_section_title extends Model
{
    protected $guarded = [];
    protected $table = 'content_section_titles';
    protected $fillable = ['title','section_id','lang_id','source_id'];

    public function contentdata(){
        return $this->belongsTo(Content_section::class);
    }

}
