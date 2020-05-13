<?php


namespace App\Http\Controllers\web\store;

use App\DataTables\UserOfflineOrdersDataTable;
use App\DataTables\userOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\countries;
use App\Models\product\orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{


    public function showProfileForm()
    {
        if (auth()->check()) {
            $user = auth()->user();
//            dd(getLang(LaravelGettext::getLocale()));
            $countries = countries::leftJoin('countries_data', 'countries_data.country_id', 'countries.id')
                ->select('countries.id as id', 'countries_data.title', 'countries_data.lang_id')
                ->where('countries_data.lang_id', getLang(session('lang')))->get();
//            dd($countries);
            return view('store.user.profile', compact('countries', 'user'));
        }
        return redirect('/store/login');

    }

    public function profile(Request $request)
    {
        //dd($request->all());
        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);

        $rules = [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'max:15'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('image')) {
            $image_tmp = $request->file('image');

            $destinationPath = public_path('uploads/users/' . $user->id);
            $extenstion = $image_tmp->getClientOriginalExtension();
            $fileName = rand(111, 99999) . '.' . $extenstion;
            $image_tmp->move($destinationPath, $fileName);
            $request->image = $fileName;
            if (!empty($user->image)) {
                $file = public_path('/uploads/users/' . $user->id . '/') . $user->image;
                @unlink($file);
            }
            $user->image = $request->image;
        }

        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->country_id = $request->input('country_id');
        $user->address = $request->address;
        $user->gender = $request->gender;

        $user->save();

        return redirect()->back()->with('success', _i('Your Profile Updated Successfully'));

    }

    public function myOrders(userOrderDataTable $order)
    {
        $user = auth()->user();
        return $order->render('store.user.index', compact('user'));
    }

    public function showorder($locale = null, $id)
    {
        $order = orders::findOrFail($id);
        $user = auth()->user();
        return view('store.user.order', compact('order', 'user'));
    }

    public function myOfflineOrders(UserOfflineOrdersDataTable $order)
    {
        $user = auth()->user();
        return $order->render('store.user.offlineOrders', compact('user'));
    }

    public function updatePassword(Request $request)
    {
        $id = auth()->user()->id;
        $user = User::findOrFail($id);
        $rules = [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();
//
        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with('flash_message', "Password changed successfully");
    }

}
