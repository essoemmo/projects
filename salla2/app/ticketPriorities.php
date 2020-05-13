<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticketPriorities extends Model
{
    protected $table = 'ticket_priorities';
    protected $fillable = [
        'name',
        'color'
    ];
}
