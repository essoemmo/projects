<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 09/07/2019
 * Time: 11:58 Õ
 */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOperation extends Mailable
{

    use Queueable, SerializesModels;

    private $isAdmin;
    private $communication_id;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($isAdmin=0, $communication_id)
    {
        $this->isAdmin  = $isAdmin;
        $this->communication_id  = $communication_id;
    }



    public function build()
    {
        return $this->markdown('emails.new_operation', ['isAdmin' => $this->isAdmin, 'id' => $this->communication_id]);
    }

}