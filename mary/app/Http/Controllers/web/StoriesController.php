<?php

namespace App\Http\Controllers\web;

use App\Models\Story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StoriesController extends Controller
{

    public function index(){
        if (!session('language')){
            $stories = Story::where('published','=','true')->where('source_id',null)->with('user')->latest()->paginate(8);
        }else{
            $stories = Story::where('published','=','true')->where('lang_id',session('language'))->with('user')->latest()->paginate(8);
        }
        return view('web.storeis.index',compact('stories'));
    }

    public function fetch(Request $request){
        if ($request->ajax()){
            if (!session('language')){
                $stories = Story::where('published','=','true')->where('source_id',null)->with('user')->latest()->paginate(8);
            }else{
                $stories = Story::where('published','=','true')->where('lang_id',session('language'))->with('user')->latest()->paginate(8);
            }
            return view('web.storeis.ajax',compact('stories'))->render();
        }
    }
}
