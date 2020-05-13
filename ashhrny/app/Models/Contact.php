<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    protected $table = 'contacts';
    public $timestamps = true;
    protected $fillable = array(
        'name',
        'email',
        'phone',
        'message',
        'subject',
        'ticket_id',
        'priority_id',
        'attach',
        'membership_number',
        'orderNumber',
    );

}
