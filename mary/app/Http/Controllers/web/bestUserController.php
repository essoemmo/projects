<?php

namespace App\Http\Controllers\web;

use App\Models\User_activity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class bestUserController extends Controller
{
    public function index(){

            $bestUser = DB::table('user_statuses')
                ->where('user_statuses.type','best')
                ->latest()->paginate(12);


            return view('web.user.bestMemeber.index',compact('bestUser'));
    }


    public function fetch(Request $request){

        if ($request->ajax()){
            $bestUser = DB::table('user_statuses')
                ->where('user_statuses.type','best')
                ->latest()->paginate(12);

            return view('web.user.bestMemeber.ajax',compact('bestUser'))->render();
        }
    }

    public function bestUsercountry(Request $request){
        $user = \App\Models\User::where('guard','=','admin')->first();

        if (Auth::check()){
            $bestUser = DB::table('user_statuses')->
            leftJoin('users','user_statuses.user_id','=','users.id')
                ->where('users.id','!=',$user->id)
                ->where('users.id','!=',\auth()->user()->id)
                ->where('users.resident_country_id' ,$request->val)
                ->where('user_statuses.type','best')
                ->paginate(12);

        }else{
            $bestUser = DB::table('user_statuses')->
            leftJoin('users','user_statuses.user_id','=','users.id')
                ->where('users.id','!=',$user->id)
                ->where('users.resident_country_id' ,$request->val)
                ->where('user_statuses.type','best')
                ->paginate(12);

        }

        return view('web.user.bestMemeber.ajax',compact('bestUser'))->render();
    }

    public function bestUserfilter(Request $request){

        $user = \App\Models\User::where('guard','=','admin')->first();
        if (Auth::check()){
            if ($request->filter == 'all'){
                $bestUser = DB::table('user_statuses')->
                leftJoin('users','user_statuses.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('user_statuses.type','best')
                    ->paginate(12);
            }else{
                $bestUser = DB::table('user_statuses')->
                leftJoin('users','user_statuses.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('users.gender' ,$request->filter)
                    ->where('user_statuses.type','best')
                    ->paginate(12);
            }
        }else{
            if ($request->filter == 'all'){
                $bestUser = DB::table('user_statuses')->
                leftJoin('users','user_statuses.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('user_statuses.type','best')
                    ->paginate(12);
            }else{
                $bestUser = DB::table('user_statuses')->
                leftJoin('users','user_statuses.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.gender' ,$request->filter)
                    ->where('user_statuses.type','best')
                    ->paginate(12);
            }
        }

        return view('web.user.bestMemeber.ajax',compact('bestUser'))->render();

    }

}
