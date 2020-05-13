<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\memberDetailsDatatable;
use App\Models\Language;
use App\Models\Membership_data_type;
use App\Models\Membership_option;
use App\Models\MemberShip_optionData;
use App\Models\Membership_type;
use App\Models\Permission_membership;
use App\Models\permission_optionMembership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;

class membershipDetailsController extends Controller
{
    public function index(memberDetailsDatatable $memberDetailsDatatable)
    {
        $title = _i('member ship details');
        return $memberDetailsDatatable->render('admin.memberShip.details.index', ['title' => $title]);
    }

    public function create(){
        $title = _i('create member ship details');
        $memberships = Membership_type::
            select(['membership_types.*',
                'membership_data_types.name',
                'membership_data_types.lang_id',
                ])
            ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
            ->where('membership_data_types.lang_id',getLang())
            ->get();
        $types = ['male','female'];
         $permissions = DB::table('permissions')->get();
        return view('admin.memberShip.details.create',compact('title','memberships','types','permissions'));
    }

    public function store(Request $request){
//        dd($request->all());
        $v = Validator::make($request->all(), [
            'price' => 'required',
            'end_date' => 'required',
            'options.*' => 'required',

        ],[],[
            'options.0' =>_i('you should add the less than option')
        ]);
        $acc = $request->all();
        $lang = Language::where('code', 'ar')->first();
        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }
            $add = Membership_type::findOrFail($request->memberShip);
             $add->type = $request->type;
             $add->price = $request->price;
             $add->expire_date = $request->end_date;
        if ($request->hasFile('image')){
            if (!is_dir(public_path('uploads/membership'))){
                mkdir(public_path('uploads/membership'));
            }
            Image::make($request->image)->save(public_path('/uploads/membership/' . $request->image->hashName()));
        }
        $add->image = $request->image->hashName();
        $add->save();

        if ($add->save()){
            $addtype = Membership_data_type::where('memberShip_type_id',$request->memberShip)->update([
               'description' => $request->descrption,
            ]);

            foreach ($request->permission as $permission){
                Permission_membership::create([
                    'permision_id' => $permission,
                    'memberShip_type_id' => $request->memberShip,
                ]);
            }

            foreach ($request->options as $option){
                Membership_option::create([
                    'options' => $option,
                    'membership_type_id' => $request->memberShip,
                ]);

            }
        }

        return Response::json(['SUCCESS']);
    }

    public function edit(Request $request,$id){
        $title = _i('edit member ship details');

        $membershipss =  Membership_type::
            select(['membership_types.*',
                'membership_data_types.name',
                'membership_data_types.description',
                'membership_data_types.lang_id',
                'membership_data_types.source_id',
            ])
            ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
            ->where('membership_types.id',$id)
            ->first();

        $membershipsss =  Membership_type::
        select(['membership_types.*',
            'membership_data_types.name',
            'membership_data_types.description',
            'membership_data_types.lang_id',
            'membership_data_types.source_id',
        ])
            ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
            ->where('membership_types.id',$id)
            ->pluck('lang_id')->toArray();

        $membershipssss =  Membership_type::
        select(['membership_types.*',
            'membership_data_types.name',
            'membership_data_types.description',
            'membership_data_types.lang_id',
            'membership_data_types.source_id',
        ])
            ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
            ->where('membership_types.id',$id)
            ->get();



        $memberships = Membership_type::
        select(['membership_types.*',
            'membership_data_types.name',
            'membership_data_types.lang_id',
        ])
            ->leftJoin('membership_data_types','membership_types.id','=','membership_data_types.memberShip_type_id')
            ->where('membership_data_types.lang_id',getLang())
            ->get();

        $types = ['together','male','female'];
        $permissions = DB::table('permissions')->get();
//        $permission_ids = permission_optionMembership::where('membership_option_id',$id)->groupBy('permision_id')->pluck('permision_id')->toArray();
        $langs = Language::get();
        $options = Membership_option::
        leftJoin('membership_option_data','membership_options.id','=','membership_option_data.membership_option_id')->
            select(['membership_options.*','membership_option_data.name','membership_option_data.lang_id'])->
        where('membership_type_id',$id)->get();
//        dd($options);

        $permisiionId = Membership_option::
        leftJoin('permission_optionmemberships','membership_options.id','=','permission_optionmemberships.membership_option_id')->
         select('membership_options.*','permission_optionmemberships.permision_id','permission_optionmemberships.membership_option_id')
            ->where('membership_options.membership_type_id',$id)
            ->groupBy('permission_optionmemberships.permision_id')
        ->pluck('permision_id')->toArray();

//        dd($permisiionId);

        return view('admin.memberShip.details.edit',compact('title','memberships','types','permissions','permisiionId','membershipss','options','langs','membershipsss','membershipssss'));

    }

    public function update(Request $request,$id){
//            dd($request->all());
        $v = Validator::make($request->all(), [
            'price' => 'required',
            'end_date' => 'required',
            'options.*' => 'required',

        ],[],[
            'options.0' =>_i('you should add the less than option')
        ]);
        $acc = $request->all();
        $lang = Language::where('code', 'ar')->first();
        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }
        $add = Membership_type::findOrFail($id);
//        dd($add);
        $add->type = $request->type;
        $add->price = $request->price;
        $add->expire_date = $request->end_date;
        if ($request->hasFile('image')){
            if (!is_dir(public_path('uploads/membership'))){
                mkdir(public_path('uploads/membership'));
            }
            Storage::disk('public_uploads')->delete('/membership/'.$add->image);
            Image::make($request->image)->save(public_path('/uploads/membership/' . $request->image->hashName()));
        }
        $add->image =   $request->image  ? $request->image->hashName() : $add->image;
        $add->save();

        if ($add->save()){
            for ($i=0 ; $i < count($request->lang_id) ; $i++) {
                $lang = Language::findOrFail($request->lang_id[$i]);

                $addtype = Membership_data_type::where('memberShip_type_id', $id)->where('lang_id', $request->lang_id[$i])->update([
                    'description' => $request->get($lang->code.'_descrption'),
                ]);
            }

            Membership_option::where('membership_type_id',$id)->delete();
            foreach ($request->options as $key => $option){
                foreach ($option as $value){
                    $addoption = Membership_option::create([
                        'membership_type_id' => $id,
                    ]);
                    MemberShip_optionData::create([
                        'name' => $value,
                        'membership_option_id' => $addoption->id,
                        'lang_id' => $key,

                    ]);
                }
                permission_optionMembership::where('membership_option_id',$addoption->id)->delete();

                foreach ($request->permission as $permission){
                    permission_optionMembership::create([
                        'permision_id' => $permission,
                        'membership_option_id' => $addoption->id,
                    ]);
                }
//
            }
//            permission_optionMembership::where('membership_option_id',$id)->delete();

        }

        return Response::json(['SUCCESS']);
    }





}
