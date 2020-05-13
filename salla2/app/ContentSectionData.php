<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentSectionData extends Model
{
    protected  $table = "content_sections_data";
    protected  $fillable = ['section_id' , 'lang_id' , 'source_id' , 'content'];
    public  $timestamps = true;
}
