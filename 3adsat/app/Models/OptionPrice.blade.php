<?php

namespace App\Models;

use Carbon\Carbon;
use DB;
//use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OptionPrice extends Model
{
//    use SoftDeletes;
    protected $guarded = ['id'];
    protected  $table ="option_price";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//    	'option_id', 'language_id', 'name'
//    ];  
  
    public function option()
    {
        return $this->belongsTo('App\Models\Option', 'option_id');
    }

   
}
