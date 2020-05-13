<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\MemberShipdataTable;
use App\Models\AlbumCategoryData;
use App\Models\Language;
use App\Models\Membership;
use App\Models\Membership_data_type;
use App\Models\Membership_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class membershipController extends Controller
{
        public function __construct()
        {
            $this->middleware(['permission:show-memberships'])->only('index');
            $this->middleware(['permission:Membership-Add'])->only('store');
            $this->middleware(['permission:Membership-Edit'])->only('update');
            $this->middleware(['permission:Membership-Delete'])->only('destroy');
        }

    public function index(MemberShipdataTable $memberShip)
    {
        return $memberShip->render('admin.memberShip.index', ['title' => _i('Member Ship')]);

    }
    public function edit(Request $request,$id){
      $data =   Membership_data_type::where('memberShip_type_id',$id)->get()
          ->pluck('name','lang_id')->toArray();
        return Response::json(['data' => $data]);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $v = Validator::make($request->all(), [
            'name.*' => 'required|max:100|unique:membership_data_types,name',
        ]);
        $acc = $request->all();
        $lang = Language::where('code', 'ar')->first();
        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }

        $addMember = Membership_type::create([]);
            // data membership
        foreach(Language::get() as $lang){
            Membership_data_type::create([
                'name' => $request->get($lang->code.'_name'),
                'memberShip_type_id' => $addMember->id,
                'lang_id' => $lang->id,
            ]);
        }
        return Response::json(['SUCCESS']);

    }


    public function update(Request $request)
    {
//        dd($request->id);

        $membershipType = Membership_data_type::where('memberShip_type_id',$request->id)->first();

        $v = Validator::make($request->all(), [
            'name.*' => [
                'required',
                Rule::unique('membership_data_types')->ignore($membershipType->id),
            ],        ]);
        $acc = $request->all();
        $lang = Language::where('code', 'ar')->first();
        if ($v->fails()) {
            return Response::json(['errors' => $v->errors()]);
        }
        // data membership
        for ($i=0 ; $i < count($request->lang_id) ; $i++){
            $lang = Language::findOrFail($request->lang_id[$i]);

            Membership_data_type::where('memberShip_type_id',$request->id)->where('lang_id',$request->lang_id[$i])->update([
                'name' => $request->get($lang->code.'_name'),
                'memberShip_type_id' => $request->id,
                'lang_id' => $request->lang_id[$i],
            ]);

        }
        return Response::json(['SUCCESS']);

    }

    public function destroy(Membership_type $membership)
    {
        $membership->delete();
        return Response::json(['SUCCESS']);

    }





}
