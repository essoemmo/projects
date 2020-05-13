<?php

namespace App\Http\Controllers;

use App\Help\Utility;
use Illuminate\Http\Request;

class SendSmsController extends Controller
{
    public function send()
    {
        return 404;
//        Utility::SmsSender('96565977333', 'test from serv5');
    }
}
