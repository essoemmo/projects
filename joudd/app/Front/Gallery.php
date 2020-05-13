<?php

namespace App\Front;

use App\Help\HasFiles;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model 
{
    use HasFiles;
    protected $table = 'galleries';
    protected $dirName = 'Gallery';
    public $timestamps = true;
    protected $fillable = array('title', 'href', 'published','lang_id', 'source_id');

}