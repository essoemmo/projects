<?php

namespace App\Http\Controllers\Master\Chat;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Chat;
use App\Models\Chat_Data;
use App\Models\Language;

class ChatController extends Controller
{

    public function index()
    {

        $chats = Chat::all();

        return view('master.chat.index', compact('chats'));
    }


    public function create()
    {
        $langs = Language::get();

        return view('master.chat.create', compact('langs'));
    }


    public function store(Request $request)
    {

        $request->validate([

            'avatar' => 'required',
            'script' => 'required',
            'video'  => 'required',

        ]);

        $input = $request->except(['avatar', 'video']);

        $file = $request->file('avatar');

       if($file){

            $fileName = $file->getClientOriginalExtension();

            $fileName =  'serv5'. uniqid() . '.' . $fileName;

            $file->move('images/', $fileName);

            $input['avatar'] = $fileName;

       }


       $video = $request->file('video');

       if($video){

            $videoName = $video->getClientOriginalExtension();

            $videoName =  'serv5'. uniqid() . '.' . $videoName;

            $video->move('images/', $videoName);

            $input['video'] = $videoName;

       }

        $chat = Chat::create($input);


        session()->flash('message', _i('Chat Added Successfully'));

        return redirect('/master/chat');


    }


    public function edit($id)
    {
        $chat = Chat::findOrFail($id);

        return view('master.chat.edit', compact('chat'));

    }


    public function update(Request $request, $id)
    {
        $request->validate([

            'script' => 'required',

        ]);

        $chat = Chat::findOrFail($id);

        $input = $request->except(['avatar', 'video']);

        $file = $request->file('avatar');

       if($file){

            $fileName = $file->getClientOriginalExtension();

            $fileName =  'serv5'. uniqid() . '.' . $fileName;

            $file->move('images/', $fileName);

            $input['avatar'] = $fileName;

       }else{

        $input['avatar'] = $chat->avatar ;
       }


       $video = $request->file('video');

       if($video){

            $videoName = $video->getClientOriginalExtension();

            $videoName =  'serv5'. uniqid() . '.' . $videoName;

            $video->move('images/', $videoName);

            $input['video'] = $videoName;

       }else{

              $input['video'] = $chat->video;
       }

        $chat->update($input);


        session()->flash('message', _i('Chat Updated Successfully'));

        return redirect('/master/chat');
    }


    public function destroy($id)
    {
        //
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
