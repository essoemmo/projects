<?php

namespace App\Http\Controllers;

use App\DataTables\countriesDataTable;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CountriesController extends Controller
{

    public function index()
    {
      
        return view('admin.country.index');
    }

    public  function get_datatable()
    {
        $countries = Countries::select(['id','title', 'code', 'logo', 'lang_id',
            'source_id','created_at'])->orderByDesc('id');

        return DataTables::of($countries )
            ->addColumn('logo', function ($countries) {
                $url = asset('uploads/countries/'.$countries->id.'/'.$countries->logo);
                return '<img src='.$url.' border="0" class=" img-rounded" align="center" style="max-width:100px; max-height:100px;"/>';
            })
            ->editColumn('lang_id', function($query) {
                $language = Language::where('id' , $query->lang_id)->first();
                return _i($language->title) ;
            })
            ->addColumn('action', 'admin.country.btn.delete')
            ->rawColumns([
                'action',
                'logo',
            ])
            ->make(true);
    }


    public function create()
    {
        $languages = Language::all() ;
        return view('admin.country.create' ,compact('languages'));
    }

    public function store(Request $request)
    {
        $rules = [
            'title' =>  ['required', 'max:191', 'unique:countries'],
            'code' =>  ['required','max:5'],
            'logo' => ['image','mimes:jpeg,jpg,png,bmp,gif,svg , jfif']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();


        $country = Countries::create([
            'title' => $request->title,
            'code' => $request->code,
            'lang_id' => $request->lang_id,
        ]);
        $country->save();


        if($request->logo)
        {
            $image = $request->file('logo');
            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/countries/'.$country->id);
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
            }
            $country->logo = $fileName;
        }
        $country->save();

        return redirect()->back()->with('flash_message',_i('Added Successfully !'));
    }


    public function edit($id)
    {
        $languages = Language::all() ;
        $country = Countries::findOrFail($id);
        return view('admin.country.edit' , compact('country' ,'languages'));
    }

    public function update(Request $request, $id)
    {
        $country = Countries::findOrFail($id);
        $rules = [
            'title' =>  ['required', 'max:150', Rule::unique('countries')->ignore($country->id)],
            'code' =>  ['required' ,'max:5'],
            'logo' => ['sometimes','image','mimes:jpeg,jpg,png,bmp,gif,svg,jfif']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('logo'))
        {
            $image = $request->file('logo');
          //  dd($request->file('logo'));
            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/countries/'.$country->id);

                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->logo = $fileName;

                if(!empty($country->logo)){
                    //delete old image
                    $file = public_path('uploads/countries/'.$country->id.'/').$country->logo;
                    @unlink($file);
                }
            }
            $country->logo = $request->logo;
        }
        $country->title = $request->title;
        $country->code = $request->code;
        $country->lang_id = $request->lang_id;
       // $country->logo = $request->logo;
        $country->save();

        return redirect()->back()->with('flash_message', 'Updated Successfully !');
    }


    public function destroy($id)
    {
        $country = Countries::findOrFail($id);

        $cities = Cities::where('country_id' ,'=',$country->id)->first();
        if($cities != null){
            return redirect()->back()->with('danger' , _i('Can`t Delete Country delete Cities From Country First !'));
        }else{
            $country->delete();
            return redirect()->back()->with('flash_message' ,_i('Deleted Successfully !'));
        }

    }

    public function list(Request $request)
    {
        $countries = Countries::where('lang_id' , $request->lang_id)->pluck("title","id");
        return $countries;
    }
}
