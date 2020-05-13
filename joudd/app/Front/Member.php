<?php

namespace App\Front;

use App\Help\HasFiles;
use Illuminate\Database\Eloquent\Model;

class Member extends Model 
{
    use HasFiles;

    protected $table = 'members';
    protected $dirName = 'Member';
    public $timestamps = true;
    protected $fillable = array('id','name', 'position', 'index', 'type', 'published', 'created');
    protected $visible = array('created');

}