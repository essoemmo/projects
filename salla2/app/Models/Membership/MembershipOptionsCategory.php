<?php

namespace App\Models\Membership;

use Illuminate\Database\Eloquent\Model;

class MembershipOptionsCategory extends Model {

    protected $table = 'membership_options_category';
    public $timestamps = true;


    public function Options() {
        return  $this->hasMany(\App\MembershipOptionsData::class, "category_id", "category_id");
    }

}
