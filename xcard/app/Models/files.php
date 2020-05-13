<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Files extends Model
{
    protected $table = 'files';
    protected $fillable = [
        'image',
        'main',
        'tag',
        'fileable_id',
        'fileable_type',
    ];
    public function fileable()
    {
        return $this->morphTo();
    }

}
