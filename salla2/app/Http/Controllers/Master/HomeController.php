<?php


namespace App\Http\Controllers\Master;


use App\Admin;
use App\ContentSection;
use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\StoreData;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function masterLang($lang)
    {

        if (session()->has('MasterLang')) {
            session()->forget('MasterLang');
        }
        session()->put('MasterLang', $lang);
        return back();
    }

    public function index()
    {

        //dd(Utility::admin());
        //dd( app('auth'));
        //dd(LaravelGettext::getLocale());
        $contents = ContentSection::count();
        $users = User::where('guard', Utility::Store)->count();
        $admins = User::where('guard', Utility::Admin)->count();
        $stores = StoreData::count();
        $contacts = Contact::count();
        return view('master.home', compact('contents', 'users', 'admins', 'stores', 'contacts'));
    }

    public function editProfile()
    {
        $user = Utility::admin()->user();
        return view('master.auth.profile', compact('user'));
    }


    public function updateProfile(Request $request)
    {
        $id = Utility::admin()->user()->id;
        $user = Admin::findOrFail($id);
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,jpg,png,bmp,gif,svg'],
        ];

        $validator = Validator::make($request->all(), $rules);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();

        } else {

            if ($request->has('image')) {
                $image_tmp = $request->file('image');

                if ($image_tmp && $file = $image_tmp->isValid()) {
                    $destinationPath = public_path('uploads/users/' . $user->id);
                    $extenstion = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111, 99999) . '.' . $extenstion;
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

            return redirect()->back()->with('success', _i('Updated Successfully !'));
        }
    }

    public function changePassword(Request $request, $id)
    {
        //$id = auth()->guard()->user()->id;
        $user = User::findOrFail($id);
        $rules = [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);

        $user->password = bcrypt($request->input('password'));
        $user->save();

        return redirect()->back()->with('success', _i('Password Changed Successfully !'));
    }


}
