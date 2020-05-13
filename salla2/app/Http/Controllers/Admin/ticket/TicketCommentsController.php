<?php

namespace App\Http\Controllers\Admin\ticket;

use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\ticket;
use App\ticketComments;
use Illuminate\Http\Request;

class TicketCommentsController extends Controller
{
    public function store(Request $request){
        $ticket = ticket::findOrFail($request->ticket);
        $content = $request->msgcontent;
        $utitlty = new Utility();
        $guard_name = $utitlty->get_guard();
        $auth = auth()->guard($guard_name)->user()->id;
        $this->validate($request,[
            'msgcontent'=>'required'
        ]);
        $comment = new ticketComments();
        $comment->content = $content;
        $comment->user_id = $ticket->user->id;
        $comment->admin_id = auth()->id();
        $comment->ticket_id = $ticket->id;
        $comment->res_comment = 1;// 1 is for admin 2 is for user
        $comment->save();
        return redirect()->back();
    }
}
