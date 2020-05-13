<?php

namespace App\Http\Controllers\Auth\store;

use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\countries;
use App\Models\product\stores;
use App\Models\Settings\Setting;
use App\Models\Settings\StoreAccount;
use App\StoreUsers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
      |--------------------------------------------------------------------------
      | Register Controller
      |--------------------------------------------------------------------------
      |
      | This controller handles the registration of new users as well as their
      | validation and creation. By default this controller uses a trait to
      | provide this functionality without requiring any additional code.
      |
     */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'store_id' => $store->id,
        ]);
    }

    // show user register form
    public function showRegistrationForm()
    {
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $setting1 = Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select('settings_data.id as id', 'settings_data.title as title', 'settings_data.lang_id as lang_id')
            ->where('store_id', session()->get('StoreId'))->where('settings_data.lang_id', 1)->get();
        $countries = countries::all();
        $categoriesnav = Category::where('lang_id', getLang(session('lang')))->where('store_id', $store->id)->get();

        return view('store.user.register', compact('countries', 'categoriesnav', 'store', 'setting1'));
    }

    // save user register data
    public function register(Request $request)
    {
//dd($request->all());
        $storeId = \App\Bll\Utility::getStoreId();

        $store_account = StoreAccount::where('store_id', $storeId)->where('is_active', 0)->first();
        if ($store_account != null) {  // check if admin store make store active or not
            session()->flash('custom_message', _i('This store is not available now for some repairs, please try again later'));
            return back();
        }

        $rules = [
            'name' => ['required', 'string', 'max:150', 'min:3'],
            'lastname' => ['required', 'string', 'max:150', 'min:3'],
            //'email' => 'required', 'string', 'email', 'max:150','unique:users,email,NULL,id,store_id,'.$storeId ,
            //'email' => 'unique:users,email,store_id'.$storeId,'required','email', 'max:150',
            'email' => [
                'required',
                Rule::unique('users')->where(function ($query) use ($storeId) {
                    return $query->where('store_id', $storeId);
                }),
            ],
            'password' => ['required', 'confirmed'],
            'phone' => ['required', 'numeric'],
            'gender' => ['required'],
            //'country_id' => ['required'],
        ];

        $messages = [
            'email.unique' => _i('This email is already registered with us. Please go to the login page to complete the login process
            if you have this ownership or enter another email'),
        ];

        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            session()->flash('error', $validator);
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $find = User::where("email", $request->email)->first();
        if ($find != null) {
            StoreUsers::create([
                'user_id' => $find->id,
                'store_id' => $store->id,
            ]);
            return back()->with('success', 'Your email is already registered at Sallatk platform.login with your email');
        }
        $request->merge(['password' => bcrypt($request->password),
            'store_id' => $store->id]);
        $user = User::create($request->all());
        $user->save();
        StoreUsers::create([
            'user_id' => $user->id,
            'store_id' => $store->id,
        ]);
        $guard_web = Utility::Web;
        $dataa = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
        if (config("app.env") != "local") {
            Mail::send('emails.storeVerifyEmail', $dataa, function ($message) use ($user) {
                \App\sendemail::sendemail($message, $user);
            });
        }
        session()->flash('success', 'Thanks to Register');
        return view('auth.store_thanks', ["email" => $request->input('email')]);
        //return redirect()->route('store.home');
    }

    public function verify($local = null, $id)
    {
        $user = User::findOrFail(decrypt($id));
        if ($user->email_verified_at != null) {
            session()->flash('error', _i('This email is activated before'));
            return redirect()->route('store.home', \LaravelGettext::getLocale());
        }
        $user->is_active = 1;
        $user->email_verified_at = date("now");
        $user->save();

        session()->flash('success', _i('Thanks for your activation.'));
        return redirect()->route('store.home', \LaravelGettext::getLocale());
    }

}
