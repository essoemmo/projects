<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ContentSectionBanner extends Model
{
    //content_section_banners
    protected $table = 'content_section_banners';
    protected $fillable = array('content_section_id', 'banner_id');
    public $timestamps = true;

}