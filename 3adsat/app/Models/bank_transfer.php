<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class bank_transfer extends Model
{
    protected $table = 'bank_transfers';
    protected $fillable = [
        'title',
        'holder_name',
        'iban',
        'holder_number',
        'logo',
        'lang_id',
        'source_id'
    ];
}
