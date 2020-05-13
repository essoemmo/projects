<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class OpenTicket extends Model
{
    use Translatable;
    protected $table = 'open_ticket';
    public $translatedAttributes = ['title', 'description'];

    public function translations(){
        return $this->hasMany('App\Models\OpenTicketTranslation','open_ticket_id','id');
    }
}
