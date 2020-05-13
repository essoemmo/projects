<?php

namespace App;

class sendemail
{

    public static function sendemail($message, $user)
    {

        $message->to($user->email, $user->name)->subject(_i('Sallatk: Thanks for your registration'));

        $message->from(\Config::get('mail.username'), 'Sallatk');

        $message->bcc(\Config::get('mail.username'), "Sallatk");

        $headers = "Reply-To: The Sender <" . \Config::get('mail.username') . ">\r\n";
        $headers .= "Return-Path: The Sender <" . \Config::get('mail.username') . ">\r\n";
        $headers .= "From: The Sender <" . \Config::get('mail.username') . ">\r\n";
        $headers .= "Organization: Sallatk\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/plain; charset=iso-8859-1\r\n";
        $headers .= "X-Priority: 3\r\n";
        $message->getSwiftMessage()->getHeaders()->addTextHeader($headers);

    }
}
