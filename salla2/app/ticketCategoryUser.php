<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ticketCategoryUser extends Model
{
    protected $table = 'ticket_category_users';
    protected $fillable =[
        'category_id',
        'user_id',
    ];
}
