<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpenTicketTranslation extends Model
{
    protected $table = 'open_ticket_translations';
    public $timestamps = false;
    protected $fillable = array('open_ticket_id', 'title', 'description', 'locale');
}
