<?php

namespace App\Http\Controllers\Admin\chat;

use App\Events\NewMessage;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactsController extends Controller
{
    public function chat(){
        return view('admin.chat.index');
    }
    public function get(){
        $messages = Message::select(DB::raw('`from` as sender_id,count(`from`) as messages_count'))
        ->where('to',auth()->user()->id)
        ->where('read',false)
        ->groupBy('from')
        ->get();
        $users = User::where('id','!=',auth()->user()->id)->get();
        $users = $users->map(function ($user) use ($messages){
            $contactUnread = $messages->where('sender_id',$user->id)->first();
            $user->unread = $contactUnread ? $contactUnread->messages_count : 0;
            return $user;
        });
        return response()->json($users);
    }
    public function conversation($id){
        Message::where('from',$id)->where('to',auth()->user()->id)->update(['read'=>true]);
        $messages = Message::where(function ($query) use ($id){
            $query->where('from','=',auth()->user()->id);
            $query->where('to','=',$id);
        })->OrWhere(function ($query) use ($id){
            $query->where('from','=',$id);
            $query->where('to','=',auth()->user()->id);
        })->get();
        return response()->json($messages);
    }
    public function send(Request $request){
         $messages = Message::create([
             'from' => auth()->user()->id,
             'to'=>$request->contact_id,
             'text'=>$request->text,
         ]);
         event(new NewMessage($messages));
         return response()->json($messages);
    }
}
