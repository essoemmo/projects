<?php

namespace App\Http\Controllers\Master;

use App\CountriesData;
use App\DataTables\countriesDataTable;
use App\Models\cities;
use App\Models\countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class CountryController extends Controller
{

    public function get_country()
    {

        $langs = Language::get();
        $countries = countries::
        leftJoin('countries_data', 'countries_data.country_id', 'countries.id')->select('countries.id as id', 'countries.code as code', 'countries_data.title as title','countries.created_at as created_at','countries.logo as logo','countries_data.lang_id as lang_id')
        ->where('countries_data.source_id' , null)
        ->orderByDesc('countries.id')
        ->get();
        //dd($countries);
        return view('master.country.index', compact('langs','countries'));
    }

    public function create(){
        return view('master.country.create');

    }

    public function getDatatablecountries()
    {
        $countries = countries::
        leftJoin('countries_data', 'countries_data.country_id', 'countries.id')->select('countries.id as id', 'countries.code as code', 'countries_data.title as title','countries.created_at as created_at','countries.logo as logo','countries_data.lang_id as lang_id')
        ->where('countries_data.source_id' , null)
        ->orderByDesc('countries.id')
        ->get();
             return DataTables::of($countries)
                ->addColumn('logo', function ($countries) {
                    $url = asset('uploads/countries/'.$countries->id.'/'.$countries->logo);
                    return '<img src='.$url.' border="0" style="width:80px; height: 80px;" class="img-responsive img-rounded" align="center" />';
                })
            ->addColumn('action', function ($countries) {
                $html = '<a href ='. $countries->id . '/edit'.' target="blank"
                class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;'.'
                   <form class=" delete"  action="'.route("country.destroy",$countries->id) .'"  method="POST" id="deleteRow"
                   style="display: inline-block; right: 50px;" >
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger" title=" '._i('Delete').' "> <span> <i class="ti-trash"></i></span></button>
                    </form>
                   </div>';

                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    if ($lang->id != $countries->lang_id){
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$countries->id.'" data-lang="'.$lang->id.'"
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
                'logo',
            ])
            ->make(true);
    }

    public function store(Request $request)
    {

        $rules = [
            'title' =>  ['required', 'max:191', 'unique:countries_data'],
            'code' =>  ['required','max:10'],
            'logo' => ['required','image','mimes:jpeg,jpg,png,bmp,gif,svg , jfif']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $country = countries::create([
            'code' => $request->code,
        ]);

        $image = $request->file('logo');

        if ($image && $file = $image->isValid()) {
            $destinationPath = public_path('uploads/countries/'.$country->id);
            $fileName = $image->getClientOriginalName();
            $image->move($destinationPath, $fileName);
            $request->logo = $fileName;
        }
        $country->logo = $request->logo;
        $country->save();
        if ($country->save()){
            CountriesData::create([
                'title' => $request->title,
                'lang_id' => $request->lang_id,
                'source_id' => null,
                'country_id' => $country->id,
            ]);
        }
        return redirect()->back()->with('success',_i('Added Successfully !'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = countries::findOrFail($id);
        $country_data = CountriesData::where('country_id' , $country->id)->where('source_id',null)->first();
        $langs = Language::get();
        return view('master.country.edit' , compact('country','langs','country_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $country = countries::findOrFail($id);

        $rules = [
            'title' => ['required'],
            'code' =>  ['required' ,'max:10'],
            'logo' => ['sometimes','image','mimes:jpeg,jpg,png,bmp,gif,svg,jfif']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('logo'))
        {
            $image = $request->logo;
            if ($image) {
                $destinationPath = public_path('uploads/countries/'.$country->id);
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->logo = $fileName;
                if(!empty($country->logo)){
                    $file = public_path('uploads/countries/'.$country->id.'/').$country->logo;
                    @unlink($file);
                }
            }
            $country->logo = $request->logo;
        }
        $country->code = $request->code;

        $country->save();
        if ($country->save()){
            CountriesData::where('country_id',$country->id)->update([
                'title' => $request->title,
                'lang_id' => $request->lang_id,
                'source_id' => null,
                'country_id' => $country->id,
            ]);
        }

        return redirect()->back()->with('success', _i('Updated Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $countrydata = CountriesData::where('country_id',$id)->delete();
        $country = countries::destroy($id);
        // $cities = cities::where('country_id' ,'=',$country->id)->first();
        // if($cities != null){
        //     return redirect()->back()->with('danger' , _i('Can`t Delete Country delete Cities From Country First !'));
        // }else{
        //     $country->delete();
        //     return redirect()->back()->with('flash_message' ,_i('Deleted Successfully !'));
        // }

        return redirect()->back()->with('success', _i('Deleted Successfully !'));

    }


    public function countrygetLangvalue(Request $request){
        $rowData = CountriesData::where('country_id',$request->transRowId)
        ->where('source_id',"=" , null)
            ->first()->title;
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);
        }
    }

    public function countrystorelangTranslation(Request $request){
        $rowData = CountriesData::where('country_id',$request->id)
        ->where('source_id',"!=" , null)
            ->first();
        if ($rowData !== null) {
            $rowData->update([
                'title' => $request->input('title'),
                'lang_id' => $request->lang_id_data,
            ]);

        }else{
            $parentRow = CountriesData::where('country_id',$request->id)->where('source_id' , null)->first();
            CountriesData::create([
                'title' => $request->input('title'),
                'lang_id' => $request->lang_id_data,
                'country_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }

}
