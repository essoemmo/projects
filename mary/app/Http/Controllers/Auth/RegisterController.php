<?php

namespace App\Http\Controllers\Auth;

use App\Models\City;
use App\Models\Material_status;
use App\Models\Membership;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',

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
        $user =  \App\Models\User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('web.user.register');
    }

    public function storemember(Request $request){
        $request->validate([
//            'memberShip' => 'required',
            'category' => 'required',
            'gendar' => 'required',
            'username' => 'required|max:15',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'nationalty' => 'required',
            'country' => 'required',
//            'city' => 'required',
            'address' => 'required',
            'option_value' => 'required|min:1',
            'fullname' => 'required',
            'mobile' => 'required',
        ],[
           'category.required' => _i('Department is required'),
           'gendar.required' => _i('gender is required'),
           'username.required' => _i('Department is required'),
           'email.required' => _i('email is required'),
           'email.unique' => _i('email is ready exist'),
           'password.required' => _i('password is required'),
           'password.confirmed' => _i('password is not confirmd'),
           'nationalty.required' => _i('Department is required'),
           'country.required' => _i('Department is required'),
           'address.required' => _i('Department is required'),
           'fullname.required' => _i('fullname is required'),
           'mobile.required' => _i('mobile is required'),
        ]);

        $addUserTable = new \App\Models\User();
        $addUserTable->username = $request->username;
        $addUserTable->email = $request->email;
        $addUserTable->password = bcrypt($request->password);
        $addUserTable->gender = $request->gendar;
        $addUserTable->address = $request->address;
        $addUserTable->guard = 'web';
        $addUserTable->age = $request->age;
        $addUserTable->about_me = $request->about_me;
        $addUserTable->partener_info = $request->partener;
        $addUserTable->fullname = $request->fullname;
        $addUserTable->mobile = $request->mobile;
        $addUserTable->nationalty_id = $request->nationalty;
        $addUserTable->resident_country_id = $request->country;
        $addUserTable->material_status_id = $request->material_status_id;
        $addUserTable->city_id = $request->city;
        $addUserTable->save();
        $addUserTable->assignRole('registered-user');

//        dd($addUserTable);

        if ($request->photo){

            Image::make($request->photo)->save(public_path('/uploads/users/'.$request->photo->hashName()));
            $addUserTable->photo = $request->photo->hashName();
        }

        if ($addUserTable->save()){
            $member = Membership::find($request->memberShip);
            $new_date = date('Y-m-d H:i:s', strtotime('+'.$member->years. 'years'));
            DB::table('user_membership')->insert([
                'user_id' => $addUserTable->id,
                'membership_id' => $request->memberShip,
                'cost' => $member->cost,
                'expire' => $new_date,
            ]);

            DB::table('user_category')->insert([
                'user_id' => $addUserTable->id,
                'category_id' => $request->category,

            ]);

            foreach ($request->option_value as $key=>$value){
                DB::table('user_options')->insert([
                    'user_id' => $addUserTable->id,
                    'option_value_id' =>$value,
                ]);
            }
            try {
                Auth::login($addUserTable);
            } catch (\Exception $e) {
                return redirect('/');
                return redirect()->intended();

            }


        }

        session()->flash('success',_i('Add Succfully'));
        return redirect()->route('home');
        return redirect()->intended();
    }

    public function get_Country(Request $request){

        $county = DB::table('nationalies_data')->where('nationalty_id',$request->id)->first();

        return response()->json(['data'=>$county]);
    }

    public function get_City(Request $request)
    {
        $city = DB::table('nationalies_data')
            ->where('id',$request->id)
            ->first();


        $cityId = City::where('nationalty_id','=',$city->nationalty_id)->first();

        if ($cityId == null){
            return response()->json(['status'=>404]);
        }
        $cityname =  DB::table('cities_data')
            ->where('city_id','=',$cityId->id)->get();
        return response()->json(['data'=>$cityname,'city_id'=>$cityId->id]);


    }


}
