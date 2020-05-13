<?php

namespace App\Http\Controllers\Admin;

use App\Bll\Utility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Settings\Setting;
use Illuminate\Support\Str;

class ChatController extends Controller
{

    public function index()
    {
        $chats = Chat::all();

        $store_id = Utility::getStoreId();

        $store = Setting::where('store_id', '=', $store_id)->first();

        $script_id = $store->script_id;

       return view('admin.chatapp.index',compact('chats','store_id', 'script_id'));
    }


    public function choose(Request $request)
    {

        $request->validate([

            'script'   => 'required',
            'store_id' => 'required',
            'chat_id'  => 'required',
            'script_id' => 'required',
        ]);

        $request->script = Str::replaceArray('APP-ID', [$request->chat_id], $request->script);

        $setting = Setting::where('store_id', '=', $request->store_id)->first();

        $setting->update([ 'chatscript' => $request->script, 'script_id' => $request->script_id]);

        session()->flash('message', _i('Chat Choosed Successfully'));

        return redirect('/adminpanel/chat/get');


    }


    public function showChatModal(Request $request) {

        try {


            $chat = Chat::findOrFail($request->id);

            return response()->json($chat);


          } catch (\Exception $e) {

              return $e->getMessage();
          }

    }



}
