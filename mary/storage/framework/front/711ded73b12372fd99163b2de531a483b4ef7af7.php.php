<?php

namespace App\Http\Controllers\web;

use App\Models\Newletters;
use App\Models\User;
use App\Models\User_activity;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Contracts\Session\Session;

use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Xinax\LaravelGettext\Facades\LaravelGettext;

class HomeController extends Controller
{
    public function home()
    {

       if (Auth::check()){
         $user =  DB::table('user_activity')->where('user_id',\auth()->user()->id)->first();
        if (!$user){
            DB::table('user_activity')->insert([
                'user_id' => \auth()->user()->id,
                'status' => 'online',
                'created' => Carbon::now(),
            ]);
        }else{
            DB::table('user_activity')->where('user_id',\auth()->user()->id)->update([
                'status' => 'online',
                'created' =>  Carbon::now(),
            ]);
        }

           $userhis =  DB::table('user_histories')->where('action','login')->where('user_id',\auth()->user()->id)->first();
           if (!$userhis){
               DB::table('user_histories')->insert([
                   'user_id' => \auth()->user()->id,
                   'action' => 'login',
                   'created' => Carbon::now(),
               ]);
           }else{
               DB::table('user_histories')->where('action','login')->where('user_id',\auth()->user()->id)->update([
                   'created' =>  Carbon::now(),
               ]);
           }


       }


       $activemember = DB::table('user_statuses')->where('type','=','active')->get();
       $bestmember = DB::table('user_statuses')->where('type','=','best')->get();
        return view('web.index',compact('activemember','bestmember'));
    }

    public function logout()
    {
        if (\auth()->check()) {

            DB::table('user_activity')->where('user_id', \auth()->user()->id)
                ->update
                ([
                    'status' => 'logout',
                    'created' => Carbon::now(),
                ]);


            $userhis =  DB::table('user_histories')->where('action','logout')->where('user_id',\auth()->user()->id)->first();
            if (!$userhis){
                DB::table('user_histories')->insert([
                    'user_id' => \auth()->user()->id,
                    'action' => 'logout',
                    'created' => Carbon::now(),
                ]);
            }else{
                DB::table('user_histories')->where('action','logout')->where('user_id',\auth()->user()->id)->update([
                    'created' =>  Carbon::now(),
                ]);
            }
        }
        
              try {
            \auth()->logout();
            \session()->flash('success','GoodBay!!');
            return redirect()->route('home');
        } catch (\Exception $e) {
                  \session()->flash('success','GoodBay!!');
                  return redirect()->route('home');
            return redirect()->intended();
        }
//        Session()->flush();
        // \auth()->logout();
        // \session()->flash('success','GoodBay!!');
        // return redirect()->route('home');
    }
    public function getLangs()
    {
        $getLangs = Language::all();
        return response()->json($getLangs);
    }

    public function changeLang(Request $request,$locale=null)
    {
        if(request()->setLanguage != null)
        {
//            dd(request()->setLanguage);
            $locale = request()->setLanguage;
        }
        $language = Language::where('name',$locale)->first();
        Request()->session()->put('language', $language->id);
//        LaravelGettext::setLocale($language->name);
        LaravelGettext::setLocale($language->code);

        return Redirect::to(URL::previous());

    }

    public function latestUser(Request $request){
        $user = \App\Models\User::where('guard','=','admin')->first();

//        $lastLogin = \App\Models\User_activity::where('login','=','login')
//            ->where('user_id','!=',$user->id)
//            ->orderBy('created', 'DESC')
//            ->paginate(24);

        if (Auth::check()){
            $latestmember = User::where('id','!=',$user->id)
                ->where('id','!=',\auth()->user()->id)
                ->latest()->paginate(12);

            }else{
            $latestmember = User::where('id','!=',$user->id)
                ->latest()->paginate(12);
               }


            return view('web.user.latestUser.index',compact('latestmember'));

    }

    public function fetch(Request $request){

        if ($request->ajax()){
            $user = \App\Models\User::where('guard','=','admin')->first();

//            $lastLogin = User_activity::where('login','=','login')
//                ->with('user')
//                ->where('user_id','!=',$user->id)
//                ->orderBy('created', 'DESC')
//                ->paginate(24);
            if (Auth::check()){
                $latestmember = User::where('id','!=',$user->id)
                    ->where('id','!=',\auth()->user()->id)
                    ->latest()->paginate(12);
            }else{
                $latestmember = User::where('id','!=',$user->id)
                    ->latest()->paginate(12);
            }

            return view('web.user.latestUser.ajax',compact('latestmember'))->render();
        }
    }


    public function latestUsercountry(Request $request){
        $user = \App\Models\User::where('guard','=','admin')->first();

        if (Auth::check()){
            $latestmember = User::where('resident_country_id',$request->val)
                ->where('id','!=',$user->id)
                ->where('id','!=',\auth()->user()->id)
                ->latest()->paginate(12);
        }else{
            $latestmember = User::where('resident_country_id',$request->val)
                ->where('id','!=',$user->id)
                ->latest()->paginate(12);

        }

        return view('web.user.latestUser.ajax',compact('latestmember'))->render();
    }

    public function latestUserfilter(Request $request){
        $user = \App\Models\User::where('guard','=','admin')->first();
        if (Auth::check()){
            if ($request->filter == 'all'){
                $latestmember = User::where('id','!=',$user->id)
                    ->where('id','!=',\auth()->user()->id)
                    ->latest()->paginate(12);
            }else{
                $latestmember = User::where('gender',$request->filter)
                    ->where('id','!=',$user->id)
                    ->where('id','!=',\auth()->user()->id)
                    ->latest()->paginate(12);
            }
        }else{
            if ($request->filter == 'all'){
                $latestmember = User::where('id','!=',$user->id)
                    ->latest()->paginate(12);
            }else{
                $latestmember = User::where('gender',$request->filter)
                    ->where('id','!=',$user->id)
                    ->latest()->paginate(12);
            }
        }


        return view('web.user.latestUser.ajax',compact('latestmember'))->render();

    }
    public function newletter(){
        return view('web.newletter.index');
    }

    public function newletterstore(Request $request){

        $email = $request->email;
//        dd($email);
        $subscriber = Newletters::where('email', '=', $email)->first();


//        dd($subscriber);
        if (!$subscriber) {
            $rules = [
                'email' => ['required', 'string', 'email', 'max:100', 'unique:newletters'],
            ];

            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())

                return redirect()->back()->withErrors($validator)->withInput();

            $subscriber = Newletters::create([
                'email' => $request->email
            ]);
            $subscriber->save();
            $request->session()->put('email', $email);
//            dd($request->session()->get('email', $email));
            return \redirect()->route('get-subscript');
//            return view('front.user.subscribe');
        } else {

            $request->session()->put('email', $email);
            return view('web.newletter.subscribe-before');
        }
    }

    public function deleteSubscriber(Request $request) {
        $email = $request->session()->get('email', $request->email);
//        dd($email);
        $subscriber = Newletters::where('email', '=', $email)->first();
//        dd($subscriber);
        if ($subscriber) {
            $subscriber->delete();
            \session()->flash('success',_i('suscribed deleted successfly'));
            return redirect('/');
        } else {
            return redirect('/');
        }
    }
}
