<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipOptionsCategoryData extends Model 
{

    protected $table = 'membership_options_category_data';
    protected $fillable = [

        'lang_id',
        'category_id',
        'title',

    ];
}