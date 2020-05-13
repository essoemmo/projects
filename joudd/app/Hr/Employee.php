<?php

namespace App\Hr;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model 
{

    protected $table = 'employees';
    public $timestamps = true;
    protected $fillable = array('name','email','personal_id','birth_date', 'organizational_unit', 'address', 'nationality', 'job','salary',
    'status','home_phone', 'mobile_phone' ,'created_at');

    public function relatives()
    {
        return $this->belongsToMany('App\Hr\Relative');
    }

}