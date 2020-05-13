<?php

namespace App\Http\Controllers\Auth;

use App\Mail\VerifyMail;
use App\Models\Front\NewsLetter;
use App\Models\VerifyUser;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Mail;

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
            'first_name' => ['required', 'string', 'max:191'],
            'last_name' => ['required', 'string', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function getRegister()
    {
        //$number = rand(1111111, 9999999);
        return view('front.user.register');
    }

    public function storeRegister(Request $request)
    {
        $number = User::where('user_type' , "famous")
            ->orWhere('user_type' , "normal")
            ->orderBy('id', 'desc')->first();
        if($number){
            $membership_number = $number['membership_number'] + 1 ;
        }else{
            $membership_number = 1;
        }

        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        //$user->membership_number = $request->membership_number;
        $user->membership_number = $membership_number;
        $user->assignRole('registered-users');
        $user->save();

//        $number = rand(1111111,9999999);
//        $verifyUser = VerifyUser::create([
//            'user_id' => $user->id,
//            'token' => sha1(time()),
//            'code' => $number,
//        ]);
//        \Mail::to($user->email)->send(new VerifyMail($user));
        return redirect(route('verify' , $user->id))->with('success', _i('Thanks for Your Registration, We Will Sent Email With Activation'));
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}
