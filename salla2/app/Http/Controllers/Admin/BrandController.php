<?php

namespace App\Http\Controllers\Admin;

use App\BrandData;
use App\DataTables\brandsDataTable;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{



    public function index()
    {
        $brands = Brand::leftJoin('brands_data' ,'brands_data.brand_id','brands.id')
        ->select('brands.*','brands_data.brand_id','brands_data.lang_id','brands_data.source_id',
        'brands_data.name','brands_data.description')
        ->where('brands_data.source_id' , null)
        ->where('store_id', \App\Bll\Utility::getStoreId())->get();
        $langs = Language::get();
        return view('admin.brands.index', compact('brands','langs'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getDatatablebrands()
    {
        $brands = Brand::leftJoin('brands_data' ,'brands_data.brand_id','brands.id')
        ->select('brands.*','brands_data.brand_id','brands_data.lang_id','brands_data.source_id',
        'brands_data.name','brands_data.description')
        ->where('brands_data.source_id' , null)
        ->where('store_id', \App\Bll\Utility::getStoreId())->get();
//dd($brands);
    return DataTables::of($brands)
        ->addColumn('image', function ($query) {
            $url = asset('/uploads/settings/brands'.'/'. $query->id .'/'. $query->image);
            return '<img src=' . $url . ' border="0" style=" width: 80px; height: 80px;" class="img-responsive img-rounded" align="center" />';
        })

        ->addColumn('action', function ($brands) {

         $html = '<a href ='.url('adminpanel/brands/')."/". $brands->id . '/edit'.' target="blank"
         class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;'.'
            <form class=" delete"  action="'.route("brands.destroy",$brands->id) .'"  method="POST" id="deleteRow"  
            style="display: inline-block; right: 50px;" > 
            <input name="_method" type="hidden" value="DELETE">
            <input type="hidden" name="_token" value="' . csrf_token() . '">
            <button type="submit" class="btn btn-danger" title=" '._i('Delete').' "> <span> <i class="ti-trash"></i></span></button>
             </form>
            </div>';

         $langs = Language::get();
         $options = '';
         foreach ($langs as $lang) {
             if ($lang->id != $brands->lang_id){
                 $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$brands->id.'" data-lang="'.$lang->id.'"
             style="display: block; padding: 5px 10px 10px;">'.$lang->title.'</a></li>';
             }
         }
         $html = $html.'
         <div class="btn-group">
           <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"  title=" '._i('Translation').' ">
             <span class="ti ti-settings"></span>
           </button>
           <ul class="dropdown-menu" style="right: auto; left: 0; width: 5em; " >
             '.$options.'
           </ul>
         </div> ';

         return $html;
        })
        
        ->rawColumns([
            'action',
            'image',
        ])
        
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $langs = Language::get();
        return view('admin.brands.create',compact('langs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sessionStore = \App\Bll\Utility::getStoreId();
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }

        $rules = [
            'name' => ['required', 'string', 'max:150'],
            'link' => 'required|max:191',
            'description' => 'required|string',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $brand = Brand::create([
                'status' => $request->status,
                'link' => $request->link,
                'published' => $request->published,
                'store_id' => session('StoreId'),
            ]);
            $image = $request->file('image');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/settings/brands/' . $brand->id . '/');
                $extension = $image->getClientOriginalExtension();
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image = $fileName;
            }

            $brand->image = $request->image;

            $brand_data = BrandData::create([
                'brand_id' => $brand->id,
                'name' => $request->name,
                'description' => $request->description,
                'lang_id' => $request->lang_id,
                'source_id' => null,
            ]);

            $brand->save();

            return view('admin.brands.index')->with('flash_message', _i('Added Successfully !'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        $brand_data = BrandData::where('brand_id' , $brand->id)->where('source_id',null)->first();
        $langs = Language::get();
        return view('admin.brands.edit',compact('brand','brand_data','langs'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $sessionStore = \App\Bll\Utility::getStoreId();
        if($sessionStore== \App\Bll\Utility::$demoId){
            return redirect()->back()->with('flash_message' , _i('Added Successfully'));
        }

        $brand = Brand::findOrFail($id);
        $rules = [
            'name' => ['required', 'string', 'max:150'],
            'link' => 'sometimes|max:191',
            'description' => 'sometimes|string',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg',
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('image')) {
            $image = $request->file('image');
            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/settings/brands/' . $brand->id . '/');
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image = $fileName;
            }
            $brand->image = $request->image;
        }
        if ($request->has('published')) {
            $brand->published = $request->published;
        } else {
            $brand->published = 0;
        }
        $brand->link = $request->link;
        $brand->store_id = $sessionStore;
        $brand_data = BrandData::where('brand_id' , $brand->id)->where('source_id',null);
        $brand_data->update([
            'brand_id' => $brand->id,
            'lang_id' => $request['lang_id'],
            'source_id' => null,
            'name' => $request['name'],
            'description' => $request['description'],
        ]);
        $brand->save();
        return redirect()->back()->with('flash_message', 'Updated Successfully !');
    }

     

    public function brandgetLangvalue(Request $request)
    {

        $rowData = BrandData::where('brand_id',$request->transRow)
        ->where('source_id',"=" , null)
        ->first(['name','description']);
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);
        }
    }


    public function brandstorelangTranslation(Request $request)
    {

        $rowData = BrandData::where('brand_id',$request->id)
        ->where('source_id', "!=", null)
            ->first();
        if ($rowData != null) {

            $rowData->update([
                'name' => $request->name,
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
            ]);

        }else{
            $parentRow = BrandData::where('brand_id',$request->id)->where('source_id',null)->first();
            BrandData::create([
                'name' => $request->name,
                'description' => $request->input('description'),
                'lang_id' => $request->lang_id_data,
                'brand_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }


    public function destroy($id)
    {
        
        $sessionStore = session()->get('StoreId');
        if ($sessionStore == \App\Bll\Utility::$demoId)
            return redirect()->back()->with('success', _i('Deleted Successfully !'));

        $brand = Brand::findOrFail($id);
        $brand->delete();
        $brand_data = BrandData::where('brand_id',$id)->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }
}
