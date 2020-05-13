<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Intervention\Image\Facades\Image;

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

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function register(Request $request)
    {
            return view('auth.register');
    }
    public function postregister(Request $request)
    {
          $request->validate([
              'firstname' => 'required|string',
              'lastname' => 'required|string',
              'email' => 'required|email|unique:users,email',
              'country' => 'required',
              'password' => 'required|min:6|confirmed',
              'mobile' => 'required|numeric|unique:users,mobile',
          ]);

          $user = new User();
          $user->first_name = $request->firstname;
          $user->last_name = $request->lastname;
          $user->email = $request->email;
          $user->country_id = $request->country;
          $user->password = bcrypt($request->password);
          $user->mobile = $request->mobile;
          $user->guard = "web";

        if ($request->image){
            Image::make($request->image)->save(public_path('/uploads/users/'.$request->image->hashName()));
            $user->image = $request->image->hashName();
        }

        $user->save();

        if ($user->save()){
            $user->assignRole('register_user');
            Auth::login($user);
            session()->flash('success',_i('successfully register'));
            return redirect()->route('homepage');
        }
    }

}
