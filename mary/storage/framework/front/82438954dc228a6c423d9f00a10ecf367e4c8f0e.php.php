<?php

namespace App\Http\Controllers\web;

use App\Models\User;
use App\Models\User_activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OnlineUserController extends Controller
{
    public function index(){
        $user = \App\Models\User::where('guard','=','admin')->first();

        if (Auth::check()){
            $onlineUser = DB::table('user_activity')->
            leftJoin('users','user_activity.user_id','=','users.id')
                ->where('users.id','!=',$user->id)
                ->where('users.id','!=',\auth()->user()->id)
                ->where('user_activity.status','online')
                ->paginate(12);
            return view('web.user.OnlineUser.index',compact('onlineUser'));
        }else{
            $onlineUser = User_activity::with('user')->
            where('status','=','online')->
            latest()->paginate(12);
        }

        return view('web.user.OnlineUser.index',compact('onlineUser'));
    }

    public function fetch(Request $request){
        $user = \App\Models\User::where('guard','=','admin')->first();

        if ($request->ajax()){
            if (Auth::check()){
                $onlineUser = DB::table('user_activity')->
                leftJoin('users','user_activity.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('user_activity.status','online')
                    ->paginate(12);
                return view('web.user.OnlineUser.index',compact('onlineUser'));
            }

            $onlineUser = User_activity::with('user')
                ->where('status','=','online')
                ->latest()->paginate(12);
            return view('web.user.OnlineUser.ajax',compact('onlineUser'))->render();
        }
    }


    public function onlineUsercountry(Request $request){
        $user = \App\Models\User::where('guard','=','admin')->first();

        if (Auth::check()){
            $onlineUser = DB::table('user_activity')->
            leftJoin('users','user_activity.user_id','=','users.id')
                ->where('users.id','!=',$user->id)
                ->where('users.id','!=',\auth()->user()->id)
                ->where('users.resident_country_id' ,$request->val)
                ->where('user_activity.status','online')
                ->paginate(12);

        }else{
            $onlineUser = DB::table('user_activity')->
            leftJoin('users','user_activity.user_id','=','users.id')
                ->where('users.id','!=',$user->id)
                ->where('users.resident_country_id' ,$request->val)
                ->where('user_activity.status','online')
                ->paginate(12);

        }

        return view('web.user.OnlineUser.ajax',compact('onlineUser'))->render();
    }

    public function onlineUserfilter(Request $request){

        $user = \App\Models\User::where('guard','=','admin')->first();
        if (Auth::check()){
            if ($request->filter == 'all'){
                $onlineUser = DB::table('user_activity')->
                leftJoin('users','user_activity.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('user_activity.status','online')
                    ->paginate(12);
            }else{
                $onlineUser = DB::table('user_activity')->
                leftJoin('users','user_activity.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('users.gender' ,$request->filter)
                    ->where('user_activity.status','online')
                    ->paginate(12);
            }
        }else{
            if ($request->filter == 'all'){
                $onlineUser = DB::table('user_activity')->
                leftJoin('users','user_activity.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('user_activity.status','online')
                    ->paginate(12);
            }else{
                $onlineUser = DB::table('user_activity')->
                leftJoin('users','user_activity.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.gender' ,$request->filter)
                    ->where('user_activity.status','online')
                    ->paginate(12);
            }
        }


        return view('web.user.OnlineUser.ajax',compact('onlineUser'))->render();

    }
}

