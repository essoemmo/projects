<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = [];
    protected $with = ['reply'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function reply()
    {
        return $this->hasOne('App\Comment' , 'comment_id');
    }
}
