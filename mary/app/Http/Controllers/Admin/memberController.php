<?php

namespace App\Http\Controllers\Admin;

use App\Models\AlbumCategory;
use App\Models\AlbumCategoryData;
use App\Models\Banner;
use App\Models\Category;
use App\Models\City;
use App\Models\Language;
use App\Models\Material_status;
use App\Models\Membership;
use App\Models\Membership_type;
use App\Models\Message;
use App\Models\Nationalty;
use App\Models\User;
use App\Models\User_login;
use App\Models\User_setting;
use App\Models\User_type;
use App\Models\UserOptionCode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\memberDataTable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Monolog\Handler\IFTTTHandler;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;


class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:show-members'])->only('index');
        $this->middleware(['permission:member-Add'])->only('create');
        $this->middleware(['permission:member-Edit'])->only('update');
        $this->middleware(['permission:member-Delete'])->only('destroy');

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
      $memberships = Membership_type::
        select(['membership_types.*',
            'membership_data_types.name',
            'membership_data_types.description',
            'membership_data_types.lang_id',
            'membership_data_types.source_id',
        ])
            ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
            ->where('membership_data_types.source_id',null)
            ->get();
        return view('admin.members.create',compact('title','memberships'));
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
//            $member = Membership_type::
            $member =  Membership_type::
            select(['membership_types.*',
                'membership_data_types.name',
                'membership_data_types.description',
                'membership_data_types.lang_id',
                'membership_data_types.source_id',
            ])
                ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
                ->where('membership_types.id',$request->memberShip)
                ->first();
//            find($request->memberShip);
//            $new_date = date('Y-m-d H:i:s', strtotime('+'.$member->years. 'years'));
            $new_date = $member->expire_date;
            DB::table('user_membership')->insert([
                   'user_id' => $addUserTable->id,
                   'membership_id' => $request->memberShip,
                   'cost' => $member->price,
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
        return redirect()->route('members.edit',$addUserTable->id);

    }


    public function edit(User $user,$id)
    {
        $title = 'edit Memebr';
        $user = User::find($id);
        $members =  \App\Models\Membership_type::
        select(['membership_types.*',
            'membership_data_types.name',
            'membership_data_types.description',
            'membership_data_types.lang_id',
            'membership_data_types.source_id',
        ])->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
            ->get();
        $membership = \Illuminate\Support\Facades\DB::table('user_membership')
            ->where('user_id',$user->id)
            ->value('membership_id');

        $department = \Illuminate\Support\Facades\DB::table('user_category')
            ->where('user_id',$user->id)
            ->value('category_id');

        $optionValue = \Illuminate\Support\Facades\DB::table('user_options')
            ->where('user_id',$user->id)
            ->pluck('option_value_id')->toArray();

        $albumm = AlbumCategory::
        leftJoin('album_category_data','album_categories.id','album_category_data.album_category_id')
            ->select(['album_categories.*','album_category_data.category','album_category_data.lang_id'])
            ->where('album_categories.user_id',$user->id)
          ->get();

       $album = AlbumCategory::
       leftJoin('album_category_data','album_categories.id','album_category_data.album_category_id')
           ->select(['album_categories.*','album_category_data.category','album_category_data.lang_id'])
           ->where('album_categories.user_id',$user->id)->
           pluck('lang_id')->toArray();


       $albumCat = AlbumCategory::where('user_id',$user->id)->first();

        return view('admin.members.edit',compact('user','title','members','membership','department','optionValue','album','albumCat','albumm'));
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
//            $member = Membership::find($request->memberShip);
            $member =  Membership_type::
            select(['membership_types.*',
                'membership_data_types.name',
                'membership_data_types.description',
                'membership_data_types.lang_id',
                'membership_data_types.source_id',
            ])
                ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
                ->where('membership_types.id',$request->memberShip)
                ->first();
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
        return redirect()->back();
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
            $statue = Material_status::where('gender','female')->where('lang_id',session('language'))->get();
            return response()->json(['data'=>$statue]);
        }else{
            $statue = Material_status::where('gender','male')->where('lang_id',session('language'))->get();
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

    public function uploadImages(Request $request,$id){
        $files = [];
        foreach ($request->file as $file){
            $imageName = time().$file->getClientOriginalName();
            $file->move(public_path('uploads/users/'.$id), $imageName);
            $user = User::findOrFail($id);
            $files[] = $user->files()->create([
                'fileable_id' => $user->id,
                'fileable_type' => get_class($user),
                'image' => '/uploads/users/'.$id.'/'. $imageName,
                'main' => 0,
                'tag' => $imageName,
            ]);
        }
        return response()->json($files);
    }

    public function deleteImages(Request $request,$id){
        $user = User::findOrFail($id);
        $file = $request->file;

        $exists = $user->files()->where('fileable_id',$id)->where('fileable_type',get_class($user))->exists();
        if ($exists){
            $photo = $user->files()->where('fileable_id',$id)->where('fileable_type',get_class($user))->where('tag', $file)->where('main',0)->first();
            $image_path = $photo->image;  // Value is not URL but directory file path
            if(File::exists(public_path($image_path))) {
                File::delete(public_path($image_path));
            }
            $photo->delete();
        }
    }

    public function addalbum(Request $request){
       $request->validate([
           'ar_title' => 'required',
           'en_title' => 'required',
           'publish' => 'required',
           'block' => 'required',
       ]);

       $user = User::findOrFail($request->user_id);
       $albummm = AlbumCategory::where('user_id',$user->id)->first();


       if ($albummm != null){
           $albummmm = AlbumCategoryData::where('album_category_id',$albummm->id)->pluck('lang_id')->toArray();
           $albumm = AlbumCategory::
           leftJoin('album_category_data','album_categories.id','album_category_data.album_category_id')
               ->select(['album_categories.*','album_category_data.category','album_category_data.lang_id'])
               ->where('album_categories.user_id',$user->id)
               ->get();
           $albummm->update([
               'published' => $request->publish,
               'user_id' => $request->user_id,
               'block' => $request->block,
           ]);
        for ($i=0 ; $i < count($request->lang_id) ; $i++){
        $lang = Language::findOrFail($request->lang_id[$i]);
            AlbumCategoryData::where('album_category_id',$albummm->id)->where('lang_id',$request->lang_id[$i])->update([
                'category' => $request->get($lang->code.'_title'),
                'lang_id' => $lang->id,
                'album_category_id' =>$albummm->id,
            ]);
        }
       }else{
           $album = AlbumCategory::create([
               'published' => $request->publish,
               'user_id' => $request->user_id,
               'block' => $request->block,
           ]);

           foreach (Language::get() as $lang){

               AlbumCategoryData::create([
                   'category' => $request->get($lang->code.'_title'),
                   'lang_id' => $lang->id,
                   'album_category_id' => $album->id,
               ]);
           }
       }

        session()->flash('success',_i('edited Succfully'));
        return back();
    }

    public function indexblock (Request $request){
            $title = _i('block user');
        if ($request->ajax()) {
            $data = User::get();
            return \Yajra\DataTables\Facades\DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function($row){
                    $user = $row->userlog == 1 ? '<span style="border-radius: 8px;
    background: green;
    padding: 3px;
    color: white;">'._i('active').'<span>'
                       :

                        '<span style="border-radius: 8px;
    background: red;
    padding: 3px;
    color: white;">'._i('stopped').'<span>';
                    return $user;
                })
                ->addColumn('action', function($row){
                    $btn = '<button href="#" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm add-data"  data-toggle="modal" data-target="#exampleModal"><i class="fa fa-edit"></i></button>';
                $btn = $btn.' <button  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-warning btn-sm show" data-toggle="modal" data-target="#exampleModal1"><i class="fa fa-eye"></i></a>';
                    return $btn;
                })
                ->rawColumns(['status','action'])
                ->make(true);

        }
        return view('admin.members.blockUser.index',compact('title'));

    }
    public function storeexpiredate(Request $request){
//        dd($request->all());

        $request->validate([
            'date' => 'required',
        ]);

        $userID = User_login::where('user_id',$request->user_id)->first();
        if ($userID){
            User_login::where('user_id',$request->user_id)->update([
                'active_data' => $request->date
            ]);
        }else{
            User_login::create([
                'user_id' => $request->user_id,
                'active_data' => $request->date,
            ]);
        }
        $user = User::findOrFail($request->user_id);
        if ($user->userlog == 1){
            $user->userlog = 0 ;
            $user->save();
        }

        session()->flash('success',_i('Add Succfully'));
        return redirect()->back();

    }

    public function getDate(Request $request){
       $date = User_login::where('user_id',$request->id)->value('active_data');

       return response()->json($date);
    }
    /*type user*/
    public function indexusertype (Request $request){


        $title = _i('type user');
        if ($request->ajax()) {
            $data = User_type::get();
            return \Yajra\DataTables\Facades\DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('type',function ($row){
                    if ($row->type == 0 ){
                        $data = _i('Normal user');
                    }else{
                        $data = _i('The matchmaker');

                    }

                    return $data;
                })
                ->addColumn('action', function($row){
                    $btn = '<a  href="'.route('type-member-edit',$row->id).'" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm add-data"><i class="fa fa-edit"></i></a>';
                    $btn = $btn.'
                        <form action="'.route('type-member-destroy',$row->id).'" method="post" style="display:inline-block;" class="delform">
                            <input name="_method" type="hidden" value="delete">
                             <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                        </form>';
                    return $btn;
                })
                ->rawColumns(['type','action'])
                ->make(true);

        }
        return view('admin.members.typeUser.index',compact('title'));
    }


    public function createusertype(Request $request){
        $codes = new UserOptionCode();
        $title = _i('setting user create');
        return view('admin.members.typeUser.create',compact('title','codes'));

    }

    public function storeusertype(Request $request){
        $request->validate([
            'options.*' => 'required',
        ]);
        $data = json_encode($request->options);

       $dataa = User_type::where('type',$request->type)->first();
       if ($dataa){
           User_type::where('type',$request->type)->update([
            'type' =>$request->type,
               'json_data' =>$data,
           ]);
       }else{
           User_type::create([
               'type' =>$request->type,
               'json_data' =>$data,
           ]);
       }

        session()->flash('success',_i('Add Succfully'));
        return redirect()->back();
    }

    public function editusertype(Request $request,$id){
        $title = _i('type user edit');
        $codes = new UserOptionCode();
        $editSetting = User_type::findOrFail($id);
        $options = json_decode($editSetting->json_data);
        return view('admin.members.typeUser.edit',compact('title','editSetting','options','codes'));
    }

    public function updateusertype(Request $request,$id){
        $request->validate([
            'options.*' => 'required',
        ]);
        $data = json_encode($request->options);

        User_type::where('id',$id)->update([
//            'type' =>$request->type,
            'json_data' =>$data,
        ]);

        session()->flash('success',_i('edited Succfully'));
        return redirect()->back();
    }

    public function destroyusertype($id){
        User_type::where('id',$id)->delete();
        return response()->json(['SUCCESS']);
    }

    /* setting user*/
    public function indexuserSetting (Request $request){
        $title = _i('setting user');
        if ($request->ajax()) {
            $data = User_setting::get();
            return \Yajra\DataTables\Facades\DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('user_id',function ($row){
                    return $row->user->username;
                })
                ->addColumn('action', function($row){
                    $btn = '<a  href="'.route('setting-member-edit',$row->id).'" data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm add-data"><i class="fa fa-edit"></i></a>';
                    $btn = $btn.'
                        <form action="'.route('setting-member-destroy',$row->id).'" method="post" style="display:inline-block;" class="delform">
                            <input name="_method" type="hidden" value="delete">
                             <input type="hidden" name="_token" value="'.csrf_token().'">
                        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash"></i></button>
                        </form>';
                    return $btn;
                })
                ->rawColumns(['user_id','action'])
                ->make(true);

        }
        return view('admin.members.userSetting.index',compact('title'));
    }

    public function createuserSetting(Request $request){
        $title = _i('setting user create');
        $data =User_type::get();
        return view('admin.members.userSetting.create',compact('title','data'));

    }

    public function storeuserSetting(Request $request){
        $request->validate([
            'options.*' => 'required',
        ]);
    $data = json_encode($request->options);

      User_setting::create([
        'user_id' =>$request->user_id,
        'json_setting' =>$data,
     ]);

        session()->flash('success',_i('Add Succfully'));
        return redirect()->back();
    }

    public function edituserSetting(Request $request,$id){
        $title = _i('setting user edit');
        $editSetting = User_setting::findOrFail($id);
        $data =User_type::get();
        $options = json_decode($editSetting->json_setting);

        return view('admin.members.userSetting.edit',compact('title','editSetting','options','data'));
    }

    public function updateuserSetting(Request $request,$id){
        $request->validate([
            'options.*' => 'required',
        ]);
        $data = json_encode($request->options);

        User_setting::where('id',$id)->update([
            'user_id' =>$request->user_id,
            'json_setting' =>$data,
        ]);

        session()->flash('success',_i('edited Succfully'));
        return redirect()->back();
    }

    public function destroyuserSetting($id){
        User_setting::where('id',$id)->delete();
        return response()->json(['SUCCESS']);
    }




}
