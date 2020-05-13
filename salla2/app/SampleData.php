<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SampleData extends Model
{
    protected $table = 'master_samles_data';
    protected $fillable = [
        'sample_id',
        'lang_id',
        'source_id',
        'description',
    ];
}
