<?php


namespace App\Http\Controllers\Master\Membership;


use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Membership\Membership;
use App\Models\Membership\MembershipData;
use App\Models\Membership\MembershipOptions;
use App\Models\Membership\MembershipOptionsCategory;
use App\Models\Membership\MembershipOptionsCategoryData;
use App\Models\Membership\MembershipOptionsMaster;
use App\Models\Membership\MembershipOpttionsData;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MembershipController extends Controller
{

    public function index()
    {

        if (request()->ajax()) {
            $query = Membership::join('memberships_data','memberships_data.membership_id','memberships.id')
                ->select(['memberships.id as id','memberships.price','memberships.duration','memberships.is_active','memberships_data.title',
                    'memberships_data.lang_id'])
                ->where('memberships_data.source_id', null)
                //->where('memberships_data.lang_id', getLang(session('MasterLang')))
                ->get();
            return Datatables::of($query)
                ->editColumn('is_active' , function($row) use ($query) {
                    if($row->is_active == 0)
                    {return  $row->is_active = _i('Not Active');  }else{  return  $row->is_active = _i('Active'); }
                })
                ->addColumn('action', function ($q ) {
                    return $this->generateHtmlEdit_Delete_btnIncreased([$q->id , $q->lang_id],$q->id ,"membership","true",$q->lang_id);
                })->rawColumns(['is_active','action'])->make(true);
        }

        return view('master.membership.index');
    }



    public function create()
    {
        $categories = MembershipOptionsCategory::leftJoin('membership_options_category_data' ,'membership_options_category_data.category_id','membership_options_category.id')
            ->select('membership_options_category.id','membership_options_category_data.title','membership_options_category_data.lang_id')
            ->where('membership_options_category_data.lang_id', getLang(session('MasterLang')))
            ->get();
        $langs = Language::get();

        return view('master.membership.create' , compact('categories','langs'));
    }

    public function store(Request $request)
    {
        
        $request['lang_id'] = $request['lang_id'] ?? getLang(session('MasterLang'));
        $request['is_active'] = $request['is_active'] ?? 0;
        $membership = Membership::create([
            'price' => $request->price,
            'duration' => $request->duration,
            'currency_code' => \App\Bll\Constants::defaultCurrency,
            'is_active' => $request['is_active'],
        ]);
        $membership_data = MembershipData::create([
            'title' => $request->title,
            'description' => $request->description,
            'info' => $request->info,
            'lang_id' => $request['lang_id'],
            'membership_id' => $membership->id,
        ]);

        foreach ($request->options as $option)
        {
            $membership_option = MembershipOptions::create([
                'membership_id' => $membership->id,
                'option_id' => $option
            ]);
        }
        return redirect()->back()->with('success' ,_i('Saved Successfully !'));
    }

    public function edit($id)
    {
        $membership = Membership::join('memberships_data','memberships_data.membership_id','memberships.id')
            ->select(['memberships.id as id','memberships.price','memberships.duration','memberships.is_active','memberships_data.title',
                'memberships_data.lang_id','memberships_data.description','memberships_data.info','memberships_data.source_id'])
            ->where('memberships_data.source_id' , null)
            ->where('memberships.id' , $id)
            ->first();

        $categories = MembershipOptionsCategory::leftJoin('membership_options_category_data' ,'membership_options_category_data.category_id','membership_options_category.id')
            ->select('membership_options_category.id','membership_options_category_data.title','membership_options_category_data.lang_id')
            ->where('membership_options_category_data.lang_id', $membership->lang_id)
           // ->where('membership_options_category_data.lang_id', getLang(session('MasterLang')))
            ->get();
        $langs = Language::get();

        $membership_options = MembershipOptions::LeftJoin('membership_options_master','membership_options_master.id','membership_options.option_id')
            ->leftJoin('membership_options_data','membership_options_data.option_id','membership_options_master.id')
            //->where('membership_options_data.lang_id', getLang(session('MasterLang')))
            ->where('membership_options_data.lang_id', $membership->lang_id)
            ->select('membership_options_master.id as id','membership_options_data.title as title')
            ->where('membership_options.membership_id' ,$id)
            ->get();

        // get categories according to options saved
        $membership_options_cat = MembershipOptions::LeftJoin('membership_options_master','membership_options_master.id','membership_options.option_id')
            ->leftJoin('membership_options_data','membership_options_data.option_id','membership_options_master.id')
            ->leftJoin('membership_options_category','membership_options_category.id','membership_options_master.category_id')
            ->leftJoin('membership_options_category_data','membership_options_category_data.category_id','membership_options_category.id')
            ->where('membership_options_data.lang_id', $membership->lang_id)
            ->where('membership_options_category_data.lang_id', $membership->lang_id)
//            ->where('membership_options_data.lang_id', getLang(session('MasterLang')))
//            ->where('membership_options_category_data.lang_id', getLang(session('MasterLang')))
            ->select('membership_options_master.id as id','membership_options_master.category_id as cat_id','membership_options_category_data.title')
            ->where('membership_options.membership_id' ,$id)->groupBy('membership_options_master.category_id')->get();

    //dd($membership_options_cat);
        return view('master.membership.edit' , compact('categories','langs','membership','membership_options','membership_options_cat'));
    }

    public function update($id , Request $request)
    {
       // dd($request);
        $request['lang_id'] = $request['lang_id'] ?? getLang(session('MasterLang'));
        $request['is_active'] = $request['is_active'] ?? 0;
        $membership = Membership::findOrFail($id);
        $membership->update([
            'price' => $request->price,
            'duration' => $request->duration,
            'currency_code' => \App\Bll\Constants::defaultCurrency,
            'is_active' => $request['is_active'],
        ]);
        $membership_data = MembershipData::where('membership_id',$membership->id)->where('source_id', null)->first();
        $membership_data->update([
            'title' => $request->title,
            'description' => $request->description,
            'info' => $request->info,
            'lang_id' => $request['lang_id'],
            'membership_id' => $membership->id,
        ]);

        $options_old = MembershipOptions::where('membership_id',$id)->delete();
        foreach ($request->options as $option)
        {
            $membership_option = MembershipOptions::create([
                'membership_id' => $membership->id,
                'option_id' => $option
            ]);
        }
        return redirect()->back()->with('success' ,_i('Updated Successfully !'));
    }

    public function delete($id)
    {
        $membership = Membership::findOrFail($id);
        $membership_data = MembershipData::where('membership_id',$id)->delete();
        $membership_option = MembershipOptions::where('membership_id',$id)->delete();
        $membership->delete();
        return redirect()->back()->with('error' ,_i('Deleted Successfully !'));
    }

    // get categories according to lang_id
    public function category_list(Request $request)
    {
        $categories = MembershipOptionsCategory::leftJoin('membership_options_category_data' ,'membership_options_category_data.category_id','membership_options_category.id')
            ->select('membership_options_category.id as id','membership_options_category_data.title as title','membership_options_category_data.lang_id')
            ->where('membership_options_category_data.lang_id', $request->lang_id)
            ->pluck("title","id");
        return $categories;
    }

    public function options_list(Request $request)
    {
        //dd($request->category_id);
        $options = MembershipOptionsMaster::leftJoin('membership_options_data','membership_options_data.option_id','membership_options_master.id')
            ->select('membership_options_master.id as id','membership_options_master.category_id as category_id','membership_options_data.title as title'
                ,'membership_options_data.lang_id')
            // ->where('membership_options_data.lang_id', getLang(session('MasterLang')))
            ->where('membership_options_data.lang_id', $request->lang_id)
            ->where('membership_options_master.category_id' , $request->category_id)->pluck("title","id");
        return $options;
    }

    public function getLangvalue(Request $request){
        //dd($request->all());
        $rowData = MembershipData::where('membership_id',$request->transRowId)
            ->where('lang_id',$request->lang_id)
            ->first(['title','description','info']);
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);

        }
    }

    public function storelangTranslation(Request $request){
         //dd($request);
        $rowData = MembershipData::where('membership_id',$request->id)
            ->where('lang_id',$request->lang_id_data)
            ->first();

        if ($rowData!==null) {
            $rowData->update([
                'title' => $request->title,
                'description' => $request->description,
                'info' => $request->info,
            ]);

        }else{
            $parentRow = MembershipData::where('membership_id',$request->id)->where('source_id' , null)->first();
            //dd($parentRow);
            MembershipData::create([
                'title' => $request->title,
                'description' => $request->description,
                'info' => $request->info,
                'lang_id' => $request->lang_id_data,
                'membership_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }

    public function deleteCategory(Request $request)
    {
        //dd($request->catId , $request->membershipId);

        $options_master = MembershipOptionsMaster::where('category_id',$request->catId)->get();
        foreach ($options_master as $option)
        {
            $membership_option = MembershipOptions::where('option_id',$option->id)->where('membership_id' ,$request->membershipId)->delete();
        }
        return response()->json('true');

    }



}