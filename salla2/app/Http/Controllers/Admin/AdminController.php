<?php


namespace App\Http\Controllers\Admin;


use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Validation\Rule;

class AdminController extends  Controller
{

    public function profile()
    {
        $guard = Utility::get_guard();
        $user =  auth()->guard($guard)->user();
//        dd($user);
        return view('admin.admin.profile' ,compact('user'));
    }

    public function update_profile(Request $request)
    {
        $guard = Utility::get_guard();
        $user_id =  auth()->guard($guard)->user()->id;
        $user = User::findOrFail($user_id);
        $rules = [
            'name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['required', 'max:15'],
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();


            if ($request->has('image')) {
                $image_tmp = $request->file('image');
    
                if ($image_tmp && $file = $image_tmp->isValid()) {
                    $destinationPath = public_path('uploads/users/' . $user->id);
                    $extenstion = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999).'.'.$extenstion;              
                    $image_tmp->move($destinationPath, $fileName);
                    $request->image = $fileName;
                    if (!empty($user->image)) {
                        $file = public_path('/uploads/users/' . $user->id . '/') . $user->image;
                        @unlink($file);
                    }
                }
                $user->image = $request->image;
            }
            
        $user->name = $request->input('name');
        $user->lastname = $request->input('lastname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();
        return redirect()->back()->with('flash_message',  _i('Profile Updated Succesfully !'));

    }

    public function update_password(Request $request )
    {
        $guard = Utility::get_guard();
        $user_id =  auth()->guard($guard)->user()->id;
        $user = User::findOrFail($user_id);
        $rules = [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $user->password = bcrypt($request->input('password'));
        $user->save();
        return redirect('adminpanel/profile')->with('flash_message', _i('Password Updated Successfully !'));
    }


    public function lang($lang) {

        if (Cookie::get('adminlang') != null) {
            Cookie::queue(Cookie::forget('adminlang'));
            session()->forget('adminlang');
        }

        Cookie::queue(Cookie::make('adminlang', $lang, 525948));
        session()->put('adminlang', $lang);



//        if (session()->has('adminlang')) {
//            session()->forget('adminlang');
//        }
//
//        session()->put('adminlang', $lang);

        return back();
    }


}
