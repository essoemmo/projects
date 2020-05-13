<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lens extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tbl_lenses';
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $fillable = ['image','name','sub_name','description','price','lang_id'];
}
