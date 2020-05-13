<?php

namespace App\Models\Article;

use App\Help\HasFiles;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    use HasFiles;
    protected $dirName = 'Article';

    protected $table = 'articles';
    public $timestamps = true;
    protected $fillable = array( 'title', 'img_url', 'content', 'published', 'created','lang_id','source_id');

}
