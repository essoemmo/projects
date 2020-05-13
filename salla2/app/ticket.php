<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{

    protected $table = 'tickets';
    protected $fillable = [
        'subject',
        'content',
        'status',
        'admin_id',
        'agent_id',
        'category_id',
        'priority_id'
    ];
    public function admin(){
        return $this->hasOne('App\Admin','id','admin_id');
    }
    public function user(){
        return $this->hasOne('App\User','id','agent_id');
    }
    public function category(){
        return $this->hasOne('App\ticketCategory','id','category_id');
    }
    public function priority(){
        return $this->hasOne('App\ticketPriorities','id','priority_id');
    }
}
