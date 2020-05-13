<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class AttributeGroupDescription extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    	'attribute_group_id', 'language_id', 'name'
    ];  
  
    public function attribute()
    {
        return $this->hasOne('App\Models\Attribute');
    }

    public static function getOneByIdAndLanguage($attribute_group_id, $language_id)
    {               
        $rowTranslation = \App\Models\AttributeGroupDescription::select('name')->where('attribute_group_id', '=', $attribute_group_id)
                ->where('language_id', '=', $language_id)->first();         
        return $rowTranslation;
    }
}
