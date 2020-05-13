<?php

namespace App\Http\Controllers;

use App\DataTables\citiesDataTable;
use App\Models\cities;
use App\Models\countries;
use App\Models\Product_type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CitiesController extends Controller
{
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
        $countries = countries::leftJoin('countries_data', 'countries_data.country_id', 'countries.id')->get();
        return view('admin.city.index', compact('countries'));
    }

    public function get_datatable()
    {
        $cities = cities::select(['id', 'title', 'country_id', 'created_at'])
            ->orderByDesc('id');

        return DataTables::of($cities)
            ->editColumn('country_id', function ($query) {
                $country = countries::leftJoin('countries_data', 'countries_data.country_id', 'countries.id')->select(['countries_data.title'])->where('countries.id', '=', $query->country_id)->first();
                return $country->title;
            })
            ->addColumn('action', function ($p) {
                return $this->generateHtmlEdit_Delete([$p->id, $p->title, $p->country_id], $p->id);
            })
//            ->addColumn('delete', function($p){
//                return view('admin.city.btn.delete');
//            })

            ->make(true);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:191|unique:cities'
        ];

        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $city = cities::create([
            'title' => $request->title,
            'country_id' => $request->country_id,
        ]);
        $city->save();
        return redirect()->back()->with('flash_message', _i('Added Successfully !'));

    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\cities $cities
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->input('id');
        $city = cities::findOrFail($id);

        $rules = [
            'title' => ['required', 'max:191', Rule::unique('cities')->ignore($city->id)]
        ];
        $validator = validator()->make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $city->title = $request->title;
        $city->country_id = $request->country_id;
        $city->save();

        return redirect()->back()->with('flash_message', _i('Updated Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\cities $cities
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $city = cities::findOrFail($id);
        $city->delete();
        return redirect()->back()->with('flash_message', _i('Deleted Successfully !'));
    }
}
