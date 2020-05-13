<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded=[];
    protected $table = 'messages';
    public $timestamps = true;
    protected $fillable = [
        'from_id',
        'to_id',
        'message',
        'message_id',
        'read_at',
    ];

//    public function user(){
//        return $this->belongsTo(User::class);
//    }
}
