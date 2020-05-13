<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipOptionsCategoryData extends Model
{
    protected $table = 'membership_options_category_data';
    protected $fillable = [
        
        'lang_id',
        'categoty_id',
        'title',

    ];

}
