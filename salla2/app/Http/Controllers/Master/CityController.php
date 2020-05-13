<?php

namespace App\Http\Controllers\Master;

use App\Models\cities;
use App\Models\CityData;
use App\Models\countries;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CityController extends Controller
{
    public function get_city()
    {
        $languages = Language::get();
        $countries = countries::
        leftJoin('countries_data', 'countries_data.country_id', 'countries.id')->select('countries.id as id', 'countries.code as code', 'countries_data.title as title','countries.created_at as created_at','countries.logo as logo','countries_data.lang_id as lang_id')
        ->where('countries_data.source_id' , null)
        ->orderByDesc('countries.id')
        ->get();
        $cities = cities::
        leftJoin('city_datas', 'city_datas.city_id', 'cities.id')->select('cities.id as id', 'city_datas.title as title','city_datas.lang_id as lang_id')
        ->where('city_datas.source_id' , null)
        ->orderByDesc('cities.id')
        ->get();
        return view('master.city.index', compact('cities','languages','countries'));
    }


    public function getDatatablecities()
    {
        $cities = cities::
        leftJoin('city_datas', 'city_datas.city_id', 'cities.id')->select('cities.id as id', 'city_datas.title as title','city_datas.lang_id as lang_id')
        ->where('city_datas.source_id' , null)
        ->orderByDesc('cities.id')
        ->get();
             return DataTables::of($cities)
            ->addColumn('action', function ($cities) {
                $html = '<a href ='. $cities->id . '/edit'.' target="blank"
                class="btn waves-effect waves-light btn-primary edit text-center" title="{{_i("Edit")}}"><i class="ti-pencil-alt"></i></a>  &nbsp;'.'
                   <form class=" delete"  action="'.route("city-delete",$cities->id) .'"  method="POST" id="deleteRow"
                   style="display: inline-block; right: 50px;" >
                   <input name="_method" type="hidden" value="DELETE">
                   <input type="hidden" name="_token" value="' . csrf_token() . '">
                   <button type="submit" class="btn btn-danger" title=" '._i('Delete').' "> <span> <i class="ti-trash"></i></span></button>
                    </form>
                   </div>';

                $langs = Language::get();
                $options = '';
                foreach ($langs as $lang) {
                    if ($lang->id != $cities->lang_id){
                        $options .= '<li ><a href="#" data-toggle="modal" data-target="#langedit" class="lang_ex" data-id="'.$cities->id.'" data-lang="'.$lang->id.'"
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
            ])
            ->make(true);
    }

    public function store(Request $request)
    {

        $rules = [
            'title' => 'required|max:191|unique:city_datas'
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $city = cities::create([
            'country_id' => $request->country_id,
        ]);
        $lang = $request->lang_id == null ? Language::first()->id :$request->lang_id;
        $city->save();
        if ($city->save()){
            CityData::create([
                'title' => $request->title,
                'city_id' => $city->id,
                'lang_id' => $lang,
                'source_id' => null,
            ]);
        }
        return redirect()->back()->with('success', _i('Added Successfully !'));

    }

    public function edit($id)
    {
        $languages = Language::get();

        $city = cities::findOrFail($id);

        $city_data = CityData::where('city_id',$city->id)->where('source_id',null)->first();

        $countries = countries::
        leftJoin('countries_data', 'countries_data.country_id', 'countries.id')->select('countries.id as id', 'countries.code as code', 'countries_data.title as title','countries.created_at as created_at','countries.logo as logo','countries_data.lang_id as lang_id')
        ->where('countries_data.source_id' , null)
        ->orderByDesc('countries.id')
        ->get();

        return view('master.city.edit', compact( 'city_data', 'city', 'languages','countries'));
    }

    public function update(Request $request)
    {

        $id = $request->input('id');
        $city = cities::findOrFail($id);
        $city_data = CityData::where('city_id',$city->id)->first();

        $rules = [
            'title' => ['required', 'max:191', Rule::unique('city_datas')->ignore($city_data->id)]
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $city->country_id = $request->country_id;
        $city->save();

        $lang = $request->lang_id == null ? Language::first()->id :$request->lang_id;

        if ($city->save()){
            CityData::where('city_id',$id)->update([
                'city_id' => $id,
                'title' => $request->title,
                //'lang_id' => $request->lang_id,
                'lang_id' => $lang,
                'source_id' => null
            ]);
        }

        return redirect()->back()->with('success', _i('Updated Successfully !'));
    }

    public function destroy(Request $request,$id)
    {
        $citydata = CityData::where('city_id',$id)->delete();
        $city = cities::destroy($id);
        return redirect()->back()->with('success', _i('Deleted Successfully !'));
    }




    public function citygetLangvalue(Request $request){
        //dd($request->all());
        $rowData = CityData::where('city_id',$request->transRowId)
        //->where('lang_id', $request->lang_id)
        ->where('source_id', "!=" , null)
            ->first()->title;
        //dd($rowData);
        if (!empty($rowData)){
            return \response()->json(['data' => $rowData]);
        }else{
            return \response()->json(['data' => false]);
        }
    }

    public function citystorelangTranslation(Request $request){
        //dd($request);
        $rowData = CityData::where('city_id',$request->id)
        ->where('source_id',"!=" , null)
            ->first();
        if ($rowData !== null) {
            $rowData->update([
                'title' => $request->input('title'),
                'lang_id' => $request->lang_id_data,
            ]);

        }else{
            $parentRow = CityData::where('city_id',$request->id)->where('source_id' , null)->first();
            CityData::create([
                'title' => $request->input('title'),
                'lang_id' => $request->lang_id_data,
                'city_id' => $request->id,
                'source_id' => $parentRow->id,
            ]);
        }
        return \response()->json("SUCCESS");
    }



}
