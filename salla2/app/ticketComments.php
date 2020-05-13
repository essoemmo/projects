<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticketComments extends Model
{
    protected $table = 'ticket_comments';
    protected $fillable = [
        'admin_id',
        'user_id',
        'ticket_id',
        'content',
        'res_comment',
    ];
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function admin(){
        return $this->hasOne('App\Admin','id','admin_id');
    }
}
