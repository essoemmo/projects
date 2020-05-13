<?php

namespace App\Http\Controllers\Auth;

use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product\stores;
use App\Store;
use App\StoreData;
use App\StoreUser;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Settings\Setting;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Language;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class LoginController extends Controller {
    /*
      |--------------------------------------------------------------------------
      | Login Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles authenticating users for the application and
      | redirecting them to your home screen. The controller uses a trait
      | to conveniently provide its functionality to your applications.
      |
     */

use AuthenticatesUsers;

    public function __construct() {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:store')->except('logout');
    }

    public function loginweb() {

        return view('auth.loginweb', []);
    }

    public function showLoginForm() {
        //isSubDomain::class;
        $arr = explode(".", request()->getHttpHost());
        $len = 1;
        //echo \Config::get('app.env');
        if (\Config::get('app.env') !== "local") {
            $len = 2;
        }
        if (count($arr) > $len) {
            $sub = $arr[0];

            $store = \App\StoreData::where("domain", $sub)->first();
            if ($store != null) {
                session()->put(\App\Bll\Constants::StoreId, $store->id);
                //return redirect("/home");
            }
        }
        //dd(\App\Bll\Utility::getStoreId());
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

        $categoriesnav = Category::where('lang_id', getLang(session('lang')))->where('store_id', $store->id)->get();
        // $setting1 = Setting::
        // leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
        //     ->select('settings_data.id as id', 'settings_data.title as title', 'settings_data.lang_id as lang_id')
        //     ->where('store_id', session()->get('StoreId'))->where('settings_data.lang_id', 1)->get();

        if (auth()->user() != null)
            return redirect('/store/' . $store->id);

        return view('store.user.login')->with(compact('categoriesnav', 'store'
                                // return view('auth.login')->with(compact('categoriesnav', 'store', 'setting1'
        ));
    }

    public function showAdminLoginForm() {
        //return view('auth.login',[]);
        return redirect('/webLogin');
    }

    public function adminLogin(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $guard = Utility::Store;

        $userActive = User::where('email', $request->email)->first();


        if ($userActive == null) {
            session()->flash('error', _i('Invalid username or password'));
            return back();
        }

        $store = store::where('owner_id', '=', $userActive->id)->first();
        if($store->is_active == 0){
            session()->flash('error', _i('This store is not available now, please contact with administration'));
            return back();
        }

//        if ($userActive->guard == $guard) {
        // dd($userActive);
//            if ($userActive->is_active == 1) {
//  dd(Auth::guard(Utility::Store));
        if (Auth::guard(Utility::Store)->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            if ($userActive->email_verified_at == null) {
                return view('front.verify', ["email" => $request->email]);
            }
            if ($userActive->is_active !== 1) {

//                $dataa = ['id' => $userActive->id,];
//                Mail::send('emails.verifyemail', $dataa, function($message) use($userActive) {
//                    \App\sendemail::sendemail($message, $userActive);
//                });
                session()->flash('error', _i('Please contact adminastrator to activate your account'));
                return back();
            }
            // if (Utility::store()->user()->guard == "store") {
            //   dd( auth()->guard(Utility::Store)->user());
            $stores = store::where('owner_id', '=', auth()->guard($guard)->user()->id)->get();
            //  dd($stores);

            if (count($stores) == 1) {
                session(['OwnerId' => auth()->guard($guard)->user()->id]);
                session(['StoreId' => $stores[0]->id]);
//                    $value = session('OwnerId');

                return redirect('adminpanel');
            } else {
                //    dd($stores);
                //  dd(auth()->guard($guard)->user());
                session(['OwnerId' => auth()->guard($guard)->user()->id]);
//                    dd(session('OwnerId'));
                return redirect('adminpanel/get_stores');
            }
            // }

            return redirect()->intended('/adminpanel');
        } else {
            session()->flash('error', _i('Invalid email address or password'));
            return back();
        }
//            } else {
//
//                $dataa = ['id' => $userActive->id,];
//                Mail::send('emails.verifyemail', $dataa, function($message) use($userActive) {
//                    \App\sendemail::sendemail($message, $userActive);
//                });
//                session()->flash('success', _i('Sorry you should active your mail first'));
//                return back();
//            }
//        }
//        return back()->with("error", _i("Account is not registered"));
        // return back()->withInput($request->only('email', 'remember'));
    }

    // save data of user login
    public function webLogin(Request $request) {

        return $this->adminLogin($request);
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6'
        ]);

        $guard = Utility::Store;
        $user = User::where('email', $request->email)->first();
        $guard = $user->guard;
        // dd($guard);
        if (Auth::guard($guard)->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect('/');
        }
        return redirect()->back()
                        ->withInput($request->only('email', 'remember'))
                        ->withErrors([
                            $this->username() => _i('Your credentials doesn`t match our service'),
        ]);
    }

    public function try_demo(Request $request) {
        // check or create user demo
        $demo_user = StoreUser::where('email', '=', 'demo@demo.com')->first();
        if (!$demo_user) {
            return view('not_found');

//            // ** using for developer user **
//            $demo_user = StoreUser::create(['email'=> 'demo@demo.com', 'password' => '$2y$10$ves64ONqAGn.zcdBVfNi..EpyFmzlI6Gmbnuf0.TBeH/C4Ouy5bAC',
//                "guard" => "store" , 'name' => 'demo', 'lastname' => 'demo','is_active' => 1,'email_verified_at' => Carbon::now()]);
//            $demo_user->save();
//
//            // check or create demo role
//            $demo_role = Role::where('name','super-demo')->first();
//            if(!$demo_role)
//            {// Create a super-store role for the demo users
//                $demo_role = Role::create(['guard_name' => 'store', 'name' => 'super-demo']);
//                $demo_role->save();
//            }
//            // get all permissions with guard store
//            $permissions = Permission::where('guard_name' , "store")->get();
//
//            foreach($permissions as $permission)
//            {
//                // attach role with permissions
//                $demo_role->givePermissionTo($permission->name);
//                // attach demo user with permissions
//                $demo_user->givePermissionTo($permission->id);
//            }
        }

        // check for store is found & attached with user or not
        $store = StoreData::where('id', \App\Bll\Utility::$demoId)->where('owner_id', $demo_user->id)->first();
        if (!$store) {
            $store = StoreData::findOrFail(\App\Bll\Utility::$demoId);
            $store->update(['owner_id' => $demo_user->id]);
        }
        $request->merge(['email' => $demo_user->email, 'password' => "123456"]);
        return $this->adminLogin($request);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
}
