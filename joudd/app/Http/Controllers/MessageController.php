<?php

namespace App\Http\Controllers;


use App\Models\Message;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class MessageController extends Controller
{

    public function allMessages() {
        if(auth()->check()) {
            $user = User::findOrFail(auth()->id());
            $messages = Message::leftJoin('users','users.id','messages.from_id')
                ->where('to_id',$user->id)
                ->select('messages.*','users.first_name','users.last_name','users.image')
                ->get();
            $count = Message::leftJoin('users','users.id','messages.from_id')
                ->where('to_id',$user->id)
                ->select('messages.*','users.first_name','users.last_name', 'users.image')
                ->where('read_at', null)
                ->count();
            return response()->json([$messages,$count]);
        }
    }


    public function userSend(Request $request) {
        $rules = [
            'message' =>  ['required','min:5'],
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
//        dd($request->all());
        if($request->message_id != null) {
            $message = Message::create([
                'message' => $request->message,
                'from_id' => auth()->id(),
                'to_id' => $request->to_id,
                'message_id' => $request->message_id,
            ]);
        } else {
            $message = Message::create([
                'message' => $request->message,
                'from_id' => auth()->id(),
                'to_id' => $request->to_id,
            ]);
        }
        $message->save();
        return redirect(URL::previous());
    }

    public function read_only(Request $request) {
        $message = Message::findOrFail($request->id_message);
        $message->read_at = Carbon::now();
        $message->save();
    }

    public function userMessages($id) {
        $user = User::findOrFail($id);
        $messages = Message::leftJoin('users','users.id','messages.from_id')
            ->where('to_id',$user->id)
            ->select('messages.*','users.first_name','users.last_name','users.image')
            ->get();
//        dd($messages);
        return view('front.user.messages', compact('messages'));
    }

    public function adminMessages($id) {
        $user = User::findOrFail($id);
        $messages = Message::leftJoin('users','users.id','messages.from_id')
            ->where('to_id',$user->id)
            ->groupBy('messages.from_id')
            ->select('messages.*','users.first_name','users.last_name','users.image')
            ->orderBy('messages.created_at','desc')
            ->get();
//        dd($messages);
        return view('admin.messages.messages', compact('messages'));
    }

    public function get_messages(Request $request) {
        $sent_by_other = Message::select('message', 'from_id as sender_user_id', 'to_id as receiver_user_id','message_id','created_at')->where('from_id', $request->from_id)->where('to_id', auth()->id());
        $messages = Message::select('message', 'from_id as sender_user_id', 'to_id as receiver_user_id','message_id','created_at')
            ->where('from_id', auth()->id())
            ->where('to_id', $request->from_id)
            ->union($sent_by_other)
            ->orderBy('created_at', 'asc')
            ->get();
        return response()->json($messages);
    }
}
