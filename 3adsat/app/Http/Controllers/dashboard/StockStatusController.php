<?php


namespace App\Http\Controllers\dashboard;


use App\DataTables\StockStatusDataTable;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\stockStatus;
use App\Models\StockStatusDescription;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StockStatusController extends Controller
{

    public $lang = "en_US";
    public $language_id;

    public function __construct() {

        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }

    public function index(StockStatusDataTable $stockstatus)
    {
        $languages = Language::all();
//        if(\request()->ajax()){
//            $stockStatuses = StockStatus::getByLanguage($this->language_id);
//            return DataTables::of($stockStatuses)
//                ->editColumn('language_id' , function($query){
//                    $language = Language::select(['name'])->where('id' , $query->language_id)->first();
//                    return _i($language->name) ;
//                })
////                ->addColumn('action', function ($p ) {
////                    return $this->generateHtmlEdit_Delete([$p->id,$p->name,$p->language_id],$p->id);
////                })
//
//                ->make(true);
//        }

        return $stockstatus->render('admin.stock_status.index', compact('languages'));
    }

    public function store(Request $request)
    {

        $rules = [
           // '*_name' => 'required|max:191|unique:stock_status_descriptions'
        ];

        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $stock_status = stockStatus::create([]);
        $stock_status->save();
        $languages = Language::all();
        foreach($languages as $lang)
        {
            $stock_status_description = StockStatusDescription::create([
                'name' => $request->get($lang->code.'_name'),
                'language_id' => $lang->id,
                'stock_status_id' => $stock_status->id,
            ]);
            $stock_status_description->save();
        }
        return redirect()->back()->with('success' , _i('Added Successfully !'));
    }

    public function update(Request $request)
    {
        //dd($request);
        $id = $request->input('id');
        $stock_status = stockStatus::findOrFail($id);

        $languages = Language::all();
        foreach($languages as $lang)
        {
            $stock_status_description = StockStatusDescription::where('language_id',$lang->id)->where('stock_status_id',$stock_status->id)->first();
            $stock_status_description->name = $request->get($lang->code.'_name');
            $stock_status_description->save();
        }
        return redirect()->back()->with('success' , _i('Updated Successfully !'));
    }


    public function destroy(Request $request )
    {
        $id = $request->input('id');
        $stock_status = stockStatus::findOrFail($id);
        $stack_status_description = StockStatusDescription::where('stock_status_id' , $stock_status->id)->delete();
        $stock_status->delete();
        return redirect()->back()->with('success' ,  _i('Deleted Successfully !'));
    }

}