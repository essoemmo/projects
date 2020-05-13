<?php

namespace App\Http\Controllers\Auth\store;

use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\product\stores;
use App\Models\Settings\Setting;
use App\Models\Settings\StoreAccount;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
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

    // show user login form
    public function showLoginForm()
    {
        //dd('ddddd');
        $store = stores::findOrFail(\App\Bll\Utility::getStoreId());

        $categoriesnav = Category::where('lang_id', getLang(session('lang')))->where('store_id', $store->id)->get();
        $setting1 = Setting::
        leftJoin('settings_data', 'settings.id', '=', 'settings_data.setting_id')
            ->select('settings_data.id as id', 'settings_data.title as title', 'settings_data.lang_id as lang_id')
            ->where('store_id', session()->get('StoreId'))->where('settings_data.lang_id', 1)->get();

        if (auth()->user() != null)
            return redirect('/store/' . $store->id);

        return view('store.user.login')->with(compact('categoriesnav', 'store', 'setting1'
        //return view('auth.login')->with(compact('categoriesnav', 'store', 'setting1'
        ));
    }

    // save data of user login
    public function login(Request $request)
    {
//        dd($request->all());        //dd(\App\Bll\Utility::getStoreId());
        $storeId = \App\Bll\Utility::getStoreId();
        $store = stores::findOrFail($storeId);
        if ($store->is_active == 0) {
            session()->flash('warning', _i('This store is not available now, please try again later'));
            return back();
        }
        $store_account = StoreAccount::where('store_id',$storeId)->where('is_active' , 0)->first();
        if($store_account != null){  // check if admin store make store active or not
            session()->flash('custom_message', _i('This store is not available now for some repairs, please try again later'));
            return back();
        }

        $find = User::join("store_users", "users.id", "store_users.user_id")->where("email", $request->email)->where("store_users.store_id", $store->id)->first();

        if ($find == null) {
            session()->flash('warning', _i('Email is not registered'));
            return back();
        }

        if ($find->email_verified_at == null) {
//            dd('assasaasd');
            return view('auth.store_check', ["email" => $request->input('email')]);
        }
        $this->validate($request, [
            'email' => 'required|email|exists:users',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard(Utility::Web)->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            //dd('fff');
            $name = User::findOrFail(\auth()->user()->id);
            $cart = Cart::content();
            $storeOptions = \App\Bll\Utility::storeOptions(\App\Bll\Utility::getStoreId())->first();
            if ($storeOptions != null) {
                if ($storeOptions->order_accept == 1) {
                    if (count($cart) == 0) {
                        $abandoned_carts = DB::table('abandoned_carts')->where('user_id', auth()->user()->id)->where("store_id", \App\Bll\Utility::getStoreId())->get();
                        if (count($abandoned_carts) > 0) {
                            foreach ($abandoned_carts as $item) {
                                $product = \App\Bll\Utility::getProduct($item->item_id);
                                Cart::add(array(
                                    'id' => $product['id'],
                                    'name' => $product['title'],
                                    'qty' => $item->qty,
                                    'price' => $item->total_price,
                                    'options' => [
                                        'description' => $product['description'],
                                        'max_count' => $product['max_count'],
                                        'image' => getimage($product->id),
                                        'features' => null,
                                        'original_price' => $product->price,
                                        'currency' => $product->currency_code,
                                    ]));
                            }
                        }
                    }
                }
            }


            if ($name)
                \session()->flash('success', _i('Welcome ' . $name->name . ' ' . $name->lastname));
            return redirect()->back();
        }

        \session()->flash('error', _i('Your credentials doesn`t match our service'));
        return redirect()->back()
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                $this->username() => _i('Your credentials doesn`t match our service'),
            ]);
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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
//        $this->middleware('guest:admin')->except('logout');
//        $this->middleware('guest:store')->except('logout');
    }

}
