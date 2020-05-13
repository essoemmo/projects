<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipOptionsData extends Model
{
    protected $table = 'membership_options_data';
    protected $fillable = [
        'option_id',
        'title',
        'lang_id',
    ];

}
