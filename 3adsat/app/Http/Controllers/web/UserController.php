<?php


namespace App\Http\Controllers\web;


use App\DataTables\userOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\OrderItem;
use App\Models\orders;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends  Controller
{


    public function showProfileForm()
    {
        if (auth()->check()){
            $user = auth()->user();
            $countries = Country::leftJoin('country_descriptions','country_descriptions.country_id','countries.id')
                ->where('countries.status',0)
                ->where('country_descriptions.language_id', getLang(session('lang')))
                ->get();
            return view('web.user.profile' , compact('countries' , 'user'));
        }
        return redirect('/user/login');
    }

    public function profile(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);

        $rules = [
            'first_name' => ['required', 'string', 'max:191'],
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
//                if (!is_dir($destinationPath)) {
//                    mkdir($destinationPath, 0766, true);
//                }
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
        $user->save();

        return redirect()->back()->with('info' , _i('Your Profile Updated Successfully'));

    }

    public function update_password(Request $request )
    {
        $user_id =  auth()->user()->id;
        $user = User::findOrFail($user_id);
        $rules = [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'old_password' => ['required', 'string', 'min:6'],
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

//        dd($user->password,Hash::check($request->input('old_password')));

        if(Hash::check($request->input('old_password'), $user->password)) {
            $user->password = bcrypt($request->input('password'));
            $user->save();
            return redirect()->back()->with('flash_message', _i('Password Updated Successfully !'));
        } else {
            return redirect()->back()->with('flash_message', _i('Old Password Doesn\'t Match !'));
        }

    }

    public function myOrders(userOrderDataTable $order)
    {
        $user = auth()->user();
        return $order->render('web.user.index',compact('user'));
    }
    public function showorder($id)
    {
        $order = orders::findOrFail($id);
        $user = auth()->user();
        return view('web.user.order',compact('order','user'));
    }

    public function orderDetails($id) {
        if(request()->cookie('code') != null){
            $countries = DB::table('countries')
                ->where('iso_code',request()->cookie('code'))->first();
        }else{
            $countries = DB::table('countries')
                ->first();
        }
        $country = DB::table('countries')->where('iso_code', $countries->iso_code)->first();
        $convert = getRate($country->iso_code);

        $order = orders::findOrFail($id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();
        $user = User::findOrFail(auth()->id());
        return view('web.user.orderDetails', compact('order','orderItems','user','convert'));
    }

}
