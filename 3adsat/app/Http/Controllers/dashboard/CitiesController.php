<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\cities;
use App\Models\Country;
use App\Models\CountryDescription;
use App\Models\Language;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CitiesController extends Controller
{

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    //extra functions
    private function editFuncMaker(array $items){
        $s = 'edit(';
        foreach($items as $item){
            $s.='\'';
            $s.=$item;
            $s.='\',';
        }
        $s =rtrim($s,',');
        $s.=')';
        return $s;
    }
    protected function generateHtmlEdit_Delete(array $items,$itemId,$deleteOnly=false){
        if($deleteOnly){
            $html = '<a href="delete?id='.$itemId.'"  class="btn waves-effect waves-light btn btn-danger">
                   <i class="fa fa-remove"></i></a></div>';
            return $html;
        }
        $html = '<div class="text-center"><a onclick="'.$this->editFuncMaker($items).'" id="item_id_'.$itemId.'" class="btn waves-effect waves-light btn-primary" data-toggle="modal" data-target="#modal-edit" title="'._i('Edit').'">
                   <i class="fa fa-edit"></i></a>&nbsp;
                   <a href="delete?id='.$itemId.'"  class="btn waves-effect waves-light btn btn-danger" title="'._i('Delete').'">
                   <i class="fa fa-trash"></i></a></div>';
        return $html;


    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index(citiesDataTable $city)
//    {
//        return $city->render('admin.city.index');
//    }
    public function index()
    {
        $countries = Country::leftJoin('country_descriptions','country_descriptions.country_id','countries.id')->where('country_descriptions.language_id',checknotsessionlang())->pluck('country_descriptions.name','countries.id');
        $languages = Language::all();
        return view('admin.city.index' , compact('countries','languages'));
    }

    public  function get_datatable()
    {
        $cities = cities::select(['id','title', 'country_id','created_at','lang_id'])
            ->orderByDesc('id');

        return DataTables::of($cities)
            ->editColumn('country_id', function($query) {
                $country = Country::leftJoin('country_descriptions','country_descriptions.country_id','countries.id')
                    ->where('countries.id' , $query->country_id)
                    ->where('country_descriptions.language_id',checknotsessionlang())->first();
                return $country->name;
            })
            ->editColumn('lang_id', function($query) {
                $language = Language::select(['name'])->where('id' , $query->lang_id)->first();
                return _i($language->name) ;
            })
            ->addColumn('action', function ($p) {
                return $this->generateHtmlEdit_Delete([$p->id,$p->title,$p->country_id,$p->lang_id],$p->id);
            })
            ->make(true);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:191|unique:cities'
        ];

        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

//        $country = CountryDescription::where('id', $request->country_id)->first();

        $city = cities::create([
            'title' => $request->title,
            'country_id' => $request->country_id,
            'lang_id' => $request->lang_id,
        ]);
        $city->save();
        return redirect()->back()->with('flash_message' , _i('Added Successfully !'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $city = cities::findOrFail($id);
//        $country = CountryDescription::where('id', $request->country_id)->first();
        $rules = [
            'title' => ['required','max:191', Rule::unique('cities')->ignore($city->id)]
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $city->title = $request->title;
        $city->country_id = $request->country_id;
        $city->lang_id = $request->lang_id;
        $city->save();

        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cities  $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $city = cities::findOrFail($id);
        $city->delete();
        return redirect()->back()->with('flash_message' ,  _i('Deleted Successfully !'));
    }
}
