<?php

namespace App\Http\Controllers\web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class activeUserController extends Controller
{
    public function index()
    {

        $activeUser = DB::table('user_statuses')
            ->where('user_statuses.type', 'active')
            ->latest()->paginate(12);


        return view('web.user.activeMember.index', compact('activeUser'));

    }


    public function fetch(Request $request){

        if ($request->ajax()){
            $activeUser = DB::table('user_statuses')
                ->where('user_statuses.type','active')
                ->latest()->paginate(12);

            return view('web.user.activeMember.ajax',compact('activeUser'))->render();
        }
    }

    public function activeUsercountry(Request $request){
        $user = \App\Models\User::where('guard','=','admin')->first();

        if (Auth::check()){
            $activeUser = DB::table('user_statuses')->
            leftJoin('users','user_statuses.user_id','=','users.id')
                ->where('users.id','!=',$user->id)
                ->where('users.id','!=',\auth()->user()->id)
                ->where('users.resident_country_id' ,$request->val)
                ->where('user_statuses.type','active')
                ->paginate(12);

        }else{
            $activeUser = DB::table('user_statuses')->
            leftJoin('users','user_statuses.user_id','=','users.id')
                ->where('users.id','!=',$user->id)
                ->where('users.resident_country_id' ,$request->val)
                ->where('user_statuses.type','active')
                ->paginate(12);

        }

        return view('web.user.activeMember.ajax',compact('activeUser'))->render();
    }

    public function activeUserfilter(Request $request){

        $user = \App\Models\User::where('guard','=','admin')->first();
        if (Auth::check()){
            if ($request->filter == 'all'){
                $activeUser = DB::table('user_statuses')->
                leftJoin('users','user_statuses.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('user_statuses.type','active')
                    ->paginate(12);
            }else{
                $activeUser = DB::table('user_statuses')->
                leftJoin('users','user_statuses.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.id','!=',\auth()->user()->id)
                    ->where('users.gender' ,$request->filter)
                    ->where('user_statuses.type','active')
                    ->paginate(12);
            }
        }else{
            if ($request->filter == 'all'){
                $activeUser = DB::table('user_statuses')->
                leftJoin('users','user_statuses.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('user_statuses.type','active')
                    ->paginate(12);
            }else{
                $activeUser = DB::table('user_statuses')->
                leftJoin('users','user_statuses.user_id','=','users.id')
                    ->where('users.id','!=',$user->id)
                    ->where('users.gender' ,$request->filter)
                    ->where('user_statuses.type','active')
                    ->paginate(12);
            }
        }

        return view('web.user.activeMember.ajax',compact('activeUser'))->render();

    }
}
