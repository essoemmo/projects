<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticketCategory extends Model
{
    protected $table = 'ticket_categories';
    protected $fillable = [
        'name',
        'color'
    ];
}
