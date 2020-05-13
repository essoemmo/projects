<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\optionGroupDatatable;
use App\DataTables\optionsdatatables;
use App\Models\Option;
use App\Models\Option_group;
use App\Models\Option_value;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class FeaturesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:show-optionGroup'])->only('index');
        $this->middleware(['permission:Feature-Add'])->only('store');
        $this->middleware(['permission:Feature-Edit'])->only('update');
        $this->middleware(['permission:Feature-Delete'])->only('destroy');

        $this->middleware(['permission:show-option'])->only('indexOption');
        $this->middleware(['permission:option-add'])->only('storeOption');
        $this->middleware(['permission:option-edit'])->only('updateOption');
        $this->middleware(['permission:option-delete'])->only('deleteOption');

    }

    public function index(optionGroupDatatable $optiongroup)
    {
        return $optiongroup->render('admin.features.optiongroup.index' , ['title' => _i('Option Group')]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'title' => 'required',
        ], [
            'title.required' => _i('title required'),
        ]);

        $addMember = new Option_group();
        $addMember->title = $request->title;
        $addMember->lang_id = $request->language;

        $addMember->save();

        session()->flash('success', _i('Add Succfully'));
        return redirect()->route('Features.index');
    }


    public function update(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'title' => 'required',
        ], [
            'title.required' => _i('title required'),
        ]);

        $addMember = Option_group::findOrFail($request->id);
        $addMember->title = $request->title;
        $addMember->lang_id = $request->language;

        $addMember->save();

        session()->flash('success', _i('edited Succfully'));
        return redirect()->route('Features.index');
    }


    public function destroy(Option_group $option, $id)
    {
        $option_group = Option_group::findOrFail($id);
        $option_group->delete();

        session()->flash('success', _i('deleted Succfully'));
        return redirect()->route('Features.index');
    }



    public function indexOption(optionsdatatables $option)
    {

        $title = 'Options';
        return $option->render('admin.features.option.index', compact('title'));
    }

    public function storeOption(Request $request)
    {


        $request->validate([
            'language' => 'required',
//            'title' => 'required',
            'option' => 'required',
        ], [
            'title.required' => _i('title required'),
        ]);

        $addOption = new Option();
        $addOption->title = $request->title;
        $addOption->lang_id = $request->language;
        $addOption->group_id = $request->group;
        $addOption->require = $request->required;

        $addOption->save();

        if ($addOption->save()) {
            foreach ($request->option as $option) {

                \App\Models\Option_value::create([
                    'option_id' => $addOption->id,
                    'title' => $option,
                    'lang_id' => $addOption->lang_id,
                ]);
            }

        }


        session()->flash('success', _i('Add Succfully'));
        return redirect()->route('index-Option');
    }

    public function deleteOption($id)
    {
        $option = \App\Models\Option::findOrFail($id);
        $option->delete();
        session()->flash('success', _i('deleted Succfully'));
        return redirect()->route('index-Option');

    }


    public function edit(Request $request)
    {
        $optionVal = Option_value::where('option_id', '=', $request->id)->
        get();
//        dd($request->id);
        return response()->json(['data' => $optionVal]);

    }

    public function updateOption(Request $request)
    {

        $request->validate([
            'language' => 'required',
//            'title' => 'required',
            'option' => 'required',
        ], [
            'title.required' => _i('title required'),
        ]);

        $editOption = Option::FindOrFail($request->id);
        $editOption->title = $request->title;
        $editOption->lang_id = $request->language;
        $editOption->group_id = $request->group;
        $editOption->require = $request->required;

        $editOption->save();

        if ($editOption->save()) {
            foreach ($request->option as $key => $value) {

                $OPTION = Option_value::where('id', $key)->first();
                if (!$OPTION) {
                    $addoption = new Option_value();
                    $addoption->title = $value;
                    $addoption->option_id = $editOption->id;
                    $addoption->lang_id = $editOption->lang_id;
                    $addoption->save();

                } else{
                    $editval = Option_value::findOrFail($key);
                    $editval->title = $value;
                    $editval->lang_id = $editOption->lang_id;
                    $editval->option_id = $editOption->id;
                    $editval->save();
                }

            }

        }

        session()->flash('success', _i('edited Succfully'));
        return redirect()->route('index-Option');
    }

    public function remove(Request $request)
    {
        if ($request->id) {

            $del = Option_value::find($request->id);
            $del->delete();
            session()->flash('success', 'Product removed successfully');
        }

    }

    public function getOption(Request $request){

        $option = DB::table('options')->where('group_id',$request->id)->get();
        return response()->json(['data'=>$option]);
    }

    public  function getlang(Request $request){

        $opt = DB::table('option_groups')->where('lang_id',$request->id)
            ->get();

        return response()->json(['data'=>$opt]);

    }
}
