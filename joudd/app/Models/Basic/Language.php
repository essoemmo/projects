<?php

namespace App\Models\Basic;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Helper\HasFiles;

class Language extends Model {

    use SoftDeletes;
//    use HasFiles;

    protected $table = 'languages';
    protected $dates = ['deleted_at'];
    protected $fillable=['id','name','code','image','active'];
    protected $dirName = 'languages';

     public function getOneBy($column, $value) {
        $object = $this->where($column, "=", $value)->first();
        if ($object != null)
            return $object;
        return null;
    }
}
