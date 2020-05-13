<?php

namespace App\Http\Controllers\Hr\Course;

use App\Http\Controllers\Controller;
use App\Models\Admin\EducationLevel;
use App\Models\Countries;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class EducationLevelController extends Controller
{

    public function index()
    {
        $countries = countries::all();
        $languages = Language::all();
        return view('admin.hr.course.courses.education_level' , compact('countries' ,'languages'));
    }

    public function get_datatable()
    {
        $education_levels = EducationLevel::select(['id','title', 'country_id','description','created_at' ,'lang_id'])
            ->orderByDesc('id');

        return DataTables::of($education_levels )
            ->editColumn('country_id', function($education_levels) {
                $country = countries::select(['title'])->where('id', '=', $education_levels->country_id)->first();
                return $country->title;
            })
            ->editColumn('lang_id' , function ($education_levels) {
                $language = Language::where('id' ,$education_levels->lang_id)->first();
                return $language["title"];
            })
            ->addColumn('action', function ($p ) {
                return $this->generateHtmlEdit_Delete([$p->id,$p->title,$p->country_id,$p->description,$p->lang_id],$p->id);
            })
            ->make(true);
    }



    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:191|unique:education_levels'
        ];

        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        for($ii = 0; $ii < count($request->country_id) ; $ii++) {
              $education_level = EducationLevel::create([
                'title' => $request->title,
                'country_id' => $request->country_id[$ii],
                'description' => $request->description,
                'lang_id' => $request->lang_id,
            ]);
        }

        $education_level->save();
        return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
    }



    public function update(Request $request)
    {
        $id = $request->input('id');
        $rules = [
            'title' => 'required|max:191',Rule::unique('education_levels')->ignore($id),
        ];

        $validator = validator()->make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $education_level = EducationLevel::where('id' ,$id)->first();
        $education_level->title = $request->title;
        $education_level->country_id = $request->country_id;
        $education_level->description = $request->description;
        $education_level->lang_id = $request->lang_id;
        $education_level->save();
        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
    }


    public function destroy(Request $request)
    {
        $id = $request->input('id');
        $education_level = EducationLevel::where('id' ,$id)->first();
        $education_level->delete();
        return redirect()->back()->with('flash_message' , _i('Deleted Successfully !'));
    }
}
