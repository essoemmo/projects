<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\City;
use App\Models\Material_status;
use App\Models\Membership;
use App\Models\Message;
use App\Models\Nationalty;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\memberDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;


class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:member-Add'])->only('create');
        $this->middleware(['permission:member-Edit'])->only('update');
        $this->middleware(['permission:member-Delete'])->only('delete');

    }


    public function index(memberDataTable $member)
    {
       return $member->render('admin.members.index' , ['title' => _i('Members')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'members';
        return view('admin.members.create',compact('title'));
    }


    public function store(Request $request)
    {

        $request->validate([
           'memberShip' => 'required',
           'category' => 'required',
           'gendar' => 'required',
           'username' => 'required',
           'email' => 'required|email|unique:users',
           'password' => 'required|confirmed',
           'nationalty' => 'required',
           'country' => 'required',
           'city' => 'required',
           'address' => 'required',
           'option_value' => 'required',
           'partener' => 'required',
           'about_me' => 'required',
        ]);

        $addUserTable = new User();
        $addUserTable->username = $request->username;
        $addUserTable->email = $request->email;
        $addUserTable->password = bcrypt($request->password);
        $addUserTable->gender = $request->gendar;
        $addUserTable->address = $request->address;
        $addUserTable->guard = 'web';

        if ($request->photo){

            Image::make($request->photo)->save(public_path('/uploads/users/'.$request->photo->hashName()));
            $addUserTable->photo = $request->photo->hashName();
        }

        $addUserTable->about_me = $request->about_me;
        $addUserTable->age = $request->age;
        $addUserTable->partener_info = $request->partener;
        $addUserTable->nationalty_id = $request->nationalty;
        $addUserTable->resident_country_id = $request->country;
        $addUserTable->material_status_id = $request->material_status_id;
        $addUserTable->city_id = $request->city;
        $addUserTable->save();

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
        }

        session()->flash('success',_i('Add Succfully'));
        return redirect()->route('members.index');

    }


    public function edit(User $user,$id)
    {
        $title = 'edit Memebr';
        $user = User::find($id);
        return view('admin.members.edit',compact('user','title'));
    }

    public function update(Request $request, User $user,$id)
    {

        $request->validate([
            'memberShip' => 'required',
            'category' => 'required',
            'gendar' => 'required',
            'username' => 'required',
            'email' => [
                'required',
                Rule::unique('users')->ignore($id),
            ],
            'password' => 'nullable|confirmed',
            'nationalty' => 'required',
            'country' => 'required',
//            'city' => 'required',
            'address' => 'required',
            'option_value' => 'required',
            'partener' => 'required',
            'about_me' => 'required',
        ]);

        $addUserTable = User::findOrFail($id);
        $addUserTable->username = $request->username;
        $addUserTable->email = $request->email;
        if (isset($request->password) && $request->password == null){
            $reqest_data = $request->except(['password', 'password_confirmation']);
        }else{
            $addUserTable->password = bcrypt($request->password);
        }
        if ($request->photo){

            if ($addUserTable->photo != 'default'){
                Storage::disk('public_uploads')->delete('/users/'.$addUserTable->photo);
            }
            Image::make($request->photo)->save(public_path('/uploads/users/'.$request->photo->hashName()));
            $addUserTable->photo = $request->photo->hashName();
        }
        $addUserTable->age = $request->age;

//        $addUserTable->password = bcrypt($request->password);
        $addUserTable->gender = $request->gendar;
        $addUserTable->address = $request->address;
        $addUserTable->guard = 'web';
        $addUserTable->about_me = $request->about_me;
        $addUserTable->partener_info = $request->partener;
        $addUserTable->nationalty_id = $request->nationalty;
        $addUserTable->resident_country_id = $request->country;
        $addUserTable->material_status_id = $request->material_status_id;
        $addUserTable->city_id = $request->city;
        $addUserTable->save();

        if ($addUserTable->save()){
            $member = Membership::find($request->memberShip);
            $new_date = date('Y-m-d H:i:s', strtotime('+'.$member->years. 'years'));
            DB::table('user_membership')->where('user_id',$addUserTable->id)->update([
                'user_id' => $addUserTable->id,
                'membership_id' => $request->memberShip,
                'cost' => $member->cost,
                'expire' => $new_date,
            ]);

            DB::table('user_category')->where('user_id',$addUserTable->id)->update([
                'user_id' => $addUserTable->id,
                'category_id' => $request->category,

            ]);
            DB::table('user_options')->where('user_id',$addUserTable->id)->delete();
            foreach ($request->option_value as $key=>$value){
                    DB::table('user_options')->insert([
                        'user_id' => $addUserTable->id,
                        'option_value_id' =>$value,
                    ]);
            }
        }

        session()->flash('success',_i('edited Succfully'));
        return redirect()->route('members.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,$id)
    {
        $delete = User::findOrFail($id);
        $delete->delete();

        session()->flash('success',_i('deleted Succfully'));
        return redirect()->route('members.index');
    }


    public function getCountry(Request $request){
        $county = DB::table('nationalies_data')->where('nationalty_id',$request->id)->first();
        return response()->json(['data'=>$county]);
    }

    public function getCity(Request $request)
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

    public function getstatue(Request $request){
        if ($request->val == 'female'){
            $statue = Material_status::whereIn('id',[1,3,4,9,10,11])->where('lang_id',session('language'))->get();
            return response()->json(['data'=>$statue]);
        }else{
            $statue = Material_status::whereIn('id',[5,6,7,8,12,13,14,15])->where('lang_id',session('language'))->get();
            return response()->json(['data'=>$statue]);
        }
    }

    public function massmember($id){
        $title = _i('show massege');
       return view('admin.members.messageMemeber',compact('title','id'));
    }

    public function  message_get_datatable(Request $request)
    {
        $message = Message::where('from_id',$request->id)->get();

        return DataTables::of($message)
            ->addColumn('to_id', function ($message) {
                $user = User::where('id',$message->to_id)->first();
            return $user->username;
            })
            ->addColumn('action', function ($message) {
                return '<a href="#"  data-id="'.$message->id.'" id="del" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-trash"></i> </a>';
            })
            ->make(true);
    }

    public function deletemass(Request $request){
        $message = Message::findOrFail($request->id);
        $message->delete();

        session()->flash('success',_i('deleted Succfully'));
        return response()->json(['status'=>'true']);
    }

    public function activemember(Request $request){
            $user = User::findOrFail($request->userid);
            $user->userlog = $request->userlog;
            $user->save();
        session()->flash('success',_i('edited Succfully'));
        return back();
    }
}
