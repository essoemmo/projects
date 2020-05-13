<?php


namespace App\Http\Controllers\Admin;


use App\Bll\Utility;
use App\CountriesData;
use App\DataTables\MarketingDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\cities;
use App\Models\countries;
use App\Models\Marketing;
use App\Models\MarketingUsers;
use App\Models\product\product_details;
use App\Store;
use App\StoreData;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;

class CampaignController extends Controller
{

    public function index(MarketingDataTable $query)
    {
        return $query->render('admin.marketing.index');
    }

    public function create()
    {
        $storeId = Utility::getStoreId();
        //dd(Utility::getStoreId());
        $old_marketingUsers = MarketingUsers::where('marketing_id' , null)->where('store_id' ,$storeId)->delete();
        $store = StoreData::where('id' , $storeId)->first();
       //$domain = request()->getScheme()."://".$store->domain.".".request()->getHost().'/home';
        $domain = request()->getScheme()."://".$store->domain.".".request()->getHost();
        $countries = countries::join('countries_data','countries_data.country_id','countries.id')
                    ->select('countries_data.title','countries.id')->where('countries_data.source_id' , null)->get();
        $cities = cities::join('city_datas','city_datas.city_id','cities.id')
            ->select('city_datas.title','cities.id')->where('city_datas.source_id' , null)->get();

        $categories = Category::select(['id', 'title','store_id', 'parent_id',  ])
            ->where('parent_id' ,'=' , null)
            ->where('store_id', $storeId)->get();

        $products = product_details::select('products.id as prod_id','product_details.title as title')
            ->join('products','products.id','=','product_details.product_id')
            ->where('products.store_id', $storeId)->get();

        return view('admin.marketing.create' , compact('domain','categories' , 'products','countries','cities'));
    }

    public function store(Request $request)
    {
        $storeId = Utility::getStoreId();
        $apply_all_conditions = $request->apply_all_conditions ?? 0;
        $is_draft = $request->is_draft ?? 0;

        if($request->campaign_target == "store"){
            $campaign_target_value = null;
        }else{
            $campaign_target_value = $request->campaign_target_value;
        }

        if($request->campaign_type_time == "now"){
            $campaign_date = null;
            $campaign_time = null;
        }else{
            $campaign_date = $request->campaign_date;
            $campaign_time = $request->campaign_time;
        }

        $marketing = Marketing::create([
            'name' => $request->campaign_name,
            'message' => $request->message,
            'url_item' => $request->url_item,
            'type' => $request->link_type,
            'apply_all_conditions' => $apply_all_conditions,
            'campaign_target' => $request->campaign_target,
            'campaign_target_value' => $campaign_target_value,
            'campaign_time' => $campaign_time,
            'campaign_date' => $campaign_date,
            'is_draft' => $is_draft,
            'store_id' => $storeId,

        ]);
        $saved_marketingUsers = MarketingUsers::where('marketing_id' , null)->where('store_id' , $storeId)->get();
        foreach($saved_marketingUsers as $market_user){
            $market_user->marketing_id = $marketing->id;
            $market_user->save();
        }

        return redirect()->back()->with('flash_message',  _i('Saved Succesfully'));
    }


    public function edit($id)
    {
        $storeId = Utility::getStoreId();
        $marketing = Marketing::findOrFail($id);

        $marketingUserSaved = MarketingUsers::where('marketing_id' , $id)->where('store_id' ,$storeId)->get();
        $ajax_marketingUsersSaved = MarketingUsers::where('marketing_id' , null)->where('store_id' ,$storeId)->delete();

        $store = StoreData::where('id' , $storeId)->first();

        $domain = request()->getScheme()."://".$store->domain.".".request()->getHost();

        $countries = countries::join('countries_data','countries_data.country_id','countries.id')
            ->select('countries_data.title','countries.id')->get();
        $cities = cities::join('city_datas','city_datas.city_id','cities.id')
            ->select('city_datas.title','cities.id')->where('city_datas.source_id' , null)->get();

        $categories = Category::select(['id', 'title','store_id', 'parent_id',  ])
            ->where('parent_id' ,'=' , null)
            ->where('store_id', $storeId)->get();

        $products = product_details::select('products.id as prod_id','product_details.title as title')
            ->join('products','products.id','=','product_details.product_id')
            ->where('products.store_id', $storeId)->get();

        return view('admin.marketing.edit' , compact('marketing','marketingUserSaved','domain','categories' , 'products','countries',
            'cities'));
    }

    public function update(Request $request , $id)
    {
        $storeId = Utility::getStoreId();
        $marketing = Marketing::findOrFail($id);

        $apply_all_conditions = $request->apply_all_conditions ?? 0;
        $is_draft = $request->is_draft ?? 0;

        if($request->campaign_target == "store"){
            $campaign_target_value = null;
        }else{
            $campaign_target_value = $request->campaign_target_value;
        }

        if($request->campaign_type_time == "now"){
            $campaign_date = null;
            $campaign_time = null;
        }else{
            $campaign_date = $request->campaign_date;
            $campaign_time = $request->campaign_time;
        }

        $marketing->update([
            'name' => $request->campaign_name,
            'message' => $request->message,
            'url_item' => $request->url_item,
            'type' => $request->link_type,
            'apply_all_conditions' => $apply_all_conditions,
            'campaign_target' => $request->campaign_target,
            'campaign_target_value' => $campaign_target_value,
            'campaign_time' => $campaign_time,
            'campaign_date' => $campaign_date,
            'is_draft' => $is_draft,
            'store_id' => $storeId,

        ]);
        $saved_marketingUsers = MarketingUsers::where('marketing_id' , null)->where('store_id' , $storeId)->get();
        foreach($saved_marketingUsers as $market_user){
            $market_user->marketing_id = $marketing->id;
            $market_user->save();
        }

        return redirect()->back()->with('flash_message',  _i('Updated Succesfully'));
    }


    public function store_marketing_users(Request $request)
    {
        //dd($request->all());
        $code = $request->marketingUser_code;
        $value = $request->get('marketingUser_'. $code);
       // dd($value , $code,$request->all());
        $marketing_user = MarketingUsers::create([
            'marketing_id' => null,
            'code' => $code,
            'value' => $value,
            'store_id' => Utility::getStoreId(),
        ]);
        $data = MarketingUsers::where('marketing_id' , null)->where('store_id', Utility::getStoreId())->get();
        return response()->json($data);
    }

    public function delete_marketing_users(Request $request)
    {
        $rowData = MarketingUsers::findOrFail($request->rowId);
        $rowData->delete();
        return response()->json(true);
    }

    public function delete($id)
    {
        $marketing = Marketing::findOrFail($id);
        $marketing_users = MarketingUsers::where('marketing_id' ,$id)->delete();
        $marketing->delete();
        return redirect()->back()->with('flash_message',  _i('Deleted Succesfully'));
    }
}
