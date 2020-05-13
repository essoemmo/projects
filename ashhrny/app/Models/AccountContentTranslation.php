<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccountContentTranslation extends Model
{
    protected $table = 'account_contents_translations';
    public $timestamps = true;
    protected $fillable = array('account_content_id', 'title', 'locale');
}
