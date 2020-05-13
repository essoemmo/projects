<?php

namespace App\Http\Controllers;


use App\Models\Message;

use App\User;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class MessageController extends Controller
{


    public function userSend(Request $request) {
        $rules = [
            'message' =>  ['required','min:10'],
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
        $admin = User::where('user_type' , "admin")->first();

        //dd($request->all());
        if($request->message_id != null) {
            $message = Message::create([
                'message' => $request->message,
                'from_id' => auth()->id(),
                'to_id' => $admin->id,
                'message_id' => $request->message_id,
            ]);
        } else {
            $message = Message::create([
                'message' => $request->message,
                'from_id' => auth()->id(),
                'to_id' => $admin->id,
            ]);
        }
        $message->save();
        return \response()->json(true);
        //return redirect(URL::previous());
    }

    public function read_message($id_message) {
        $message = Message::findOrFail($id_message);
        $message->read_at = Carbon::now();
        $message->save();
        return \response()->json($message);
    }



    // admin send message to user
    public function adminSendMessage(Request $request){
        $user = User::findOrFail($request->to_id);
    }
}
