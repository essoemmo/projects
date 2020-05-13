<?php

namespace App\Http\Controllers;

use App\DataTables\countriesDataTable;
use App\Models\cities;
use App\Models\countries;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(countriesDataTable $country)
    {
        return $country->render('admin.country.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.country.create');
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
            'title' =>  ['required', 'max:191', 'unique:articles'],
            'code' =>  ['required','max:10'],
            'logo' => ['required','image','mimes:jpeg,jpg,png,bmp,gif,svg , jfif']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();


        $country = countries::create([
            'title' => $request->title,
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

        return redirect()->back()->with('flash_message',_i('Added Successfully !'));
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
        return view('admin.country.edit' , compact('country'));
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
        //dd($request->all());
        $country = countries::findOrFail($id);
        $rules = [
            'title' =>  ['required', 'max:150', Rule::unique('countries_data')->ignore($country->id)],
            'code' =>  ['required' ,'max:10'],
            'logo' => ['sometimes','image','mimes:jpeg,jpg,png,bmp,gif,svg,jfif']
        ];
        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        if ($request->has('logo'))
        {
            $image = $request->file('logo');

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
        $country->data->title = $request->title;
        $country->logo = $request->logo;
        $country->save();

        return redirect()->back()->with('flash_message', _i('Updated Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\countries  $countries
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country = countries::findOrFail($id);

        $cities = cities::where('country_id' ,'=',$country->id)->first();
        if($cities != null){
            return redirect()->back()->with('danger' , _i('Can`t Delete Country delete Cities From Country First !'));
        }else{
            $country->delete();
            return redirect()->back()->with('flash_message' ,_i('Deleted Successfully !'));
        }

    }
}
