<?php

namespace App\Http\Controllers\Security;

use App\DataTables\storeDataTable;
use App\Help\Utility;
use App\Http\Controllers\Controller;
use App\Models\product\stores;
use App\Store;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class StoreController extends Controller
{

    public function get_stores()
    {

//        $guard = Utility::get_guard();
//dd(Auth::check());
//dd(auth()->guard(Utility::Store)->user());
        $user = auth()->user();
        $lang = 'es_AR';
        session()->has('lang') ? session()->forget('lang'):'';
        $lang == 'es_AR' ? session()->put('lang','es_AR') : session()->put('lang','en_US');
     //   dd(session()->get("OwnerId"));
       // dd(auth()->user());
        $stores = \App\StoreData::where('owner_id', '=' , session()->get("OwnerId"))->get();

//            dd(auth()->user()->id);
 return view('admin.home.stores' ,compact('stores'));
        if(Auth::check(Utility::Store)){
            return view('admin.home.stores' ,compact('stores'));
        }else{
            return redirect('adminpanel/login');
        }
    }
    public function getSessionStore($id)
    {
        $exists = stores::where('id',$id)->exists();

        if ($exists){
            $store = stores::where('id',$id)->first();
            session()->put('StoreId',$id);
            session()->has('lang') ? session()->forget('lang') : '';
            session()->put('lang','es_AR');
            return redirect('adminpanel');
        }
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(storeDataTable $store)
    {
        return $store->render('security.store.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles =  Role::where('guard_name','store')->get();
        return view('security.store.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules =  [
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $sessionStore = session()->get('StoreId');
            if($sessionStore== \App\Bll\Utility::$demoId){
                return redirect()->back()->with('flash_message' , _i('Added Successfully'));
            }

            $user = Store::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'guard' => 'store',
            ]);
            foreach($request->roles as $key => $value){
                $user = Store::find($user->id); // get id of new user
                $user->assignRole($value); // attached new user with role
                $roles[] = $value;     // make array of roles that selected
                $permissions[] = $user->getPermissionsViaRoles($roles);  // make array of permissions via roles that selected before
            }
            $user = $user->givePermissionTo($permissions); // attached new user with permissions that belonges to roles selected before
            $user->save();
//            return redirect('/adminpanel/user/'.$user->id.'/edit')->withFlashMessage(_i('Added Successfully !'));
            return redirect()->back()->withFlashMessage(_i('Added Successfully !'));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Store::find($id);
        $roles = Role::where('guard_name','store')->get();
        return view('security.store.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Store::findOrFail($id);
        $rules =  [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => ['sometimes','confirmed'],
            'roles' => ['sometimes'],
        ];
        $sessionStore = session()->get('StoreId');
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Updated Successfully'));
        }

        if($request->has('roles'))
        {
//            DB::table('model_has_roles')->where('model_id',$user->id)->delete();
            $user->syncRoles($request->roles); // All current roles will be removed from the user and replaced by the array given (roles[])
            $permissions[] = $user->getPermissionsViaRoles($request->roles); // get Permissions inherited from the user's roles
            $user->syncPermissions($permissions);// All permissions via roles[] will be removed from the user and replaced by the array given (permissions[])
        }
        if(!is_null($request->password)){
            $rules['password'] = ['confirmed', 'min:6'];
        }
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);


        $user->name = $request->input('name');
        $user->email = $request->input('email');


        if($request->has('password') && $request->input('password') != null)
        {
//            dd($request->input('password'));
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect('/adminpanel/store/'.$user->id.'/edit')->withFlashMessage(_i('Profile Updated Successfully !')); // return if is update profile
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sessionStore = session()->get('StoreId');
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully'));
        }

        $store = Store::findOrFail($id);
        $store->delete();
        return redirect()->back()->withFlashMessage(_i('succesfuly delete'));
    }
}
