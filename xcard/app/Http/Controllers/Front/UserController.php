<?php

namespace App\Http\Controllers\Front;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\SiteLanguage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function profile() {
        $user = User::findOrFail(auth()->id());
        $countries = Country::select('countries_translations.title as title' ,'countries.id as id' ,'countries.logo' ,'countries.code')
            ->leftJoin('countries_translations','countries_translations.country_id','=','countries.id')->where('locale',App::getLocale())->get();
        $langs = SiteLanguage::all();
        return view('front.user.profile', compact('user','countries','langs'));
    }

    public function store(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);

        $rules = [
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('users')->ignore($user->id)],
            'mobile' => ['required', 'max:15'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('image') && $request->image != null )
        {
            $image = $request->file('image');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/profiles/'.$user->id.'/');
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image = $fileName;

                if(!empty($user->image)){
                    //delete old image
                    $file = public_path('uploads/profiles/'.$user->id.'/').$user->image;
                    @unlink($file);
                }
            }
            $user->image = $request->image;
        }


        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->mobile = $request->input('mobile');
        $user->country_id = $request->input('country_id');
        $user->site_language_id = $request->input('site_language_id');
        $user->save();

        return redirect()->back()->with('success' , _i('Your Profile Updated Successfully'));

    }

    public function orders() {
        $user = User::findOrFail(auth()->id());
        $orders = Order::where('user_id', $user->id)->get();
        return view('front.user.user_orders', compact('user','orders'));
    }

    public function orderDetails($id) {
        $order = Order::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $user = User::findOrFail(auth()->id());
        return view('front.user.orderDetails', compact('order','orderItems','user'));
    }
}
