<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\material_statusDataTable;
use App\Models\Material_status;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class materialStatus extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:show-material_status'])->only('index');
        $this->middleware(['permission:materialStatus-Add'])->only('store');
        $this->middleware(['permission:materialStatus-Edit'])->only('update');
        $this->middleware(['permission:materialStatus-Delete'])->only('destroy');
    }

    public function index(material_statusDataTable $matrial)
    {
        return $matrial->render('admin.material_status.index' , ['title' => _i('Material Status')]);

    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'title' => 'required',
        ],[
            'title.required'=>_i('title required'),
        ]);

        $addMember = new Material_status();
        $addMember->name = $request->title;
        $addMember->gender = $request->gender;
        $addMember->lang_id = $request->language;

        $addMember->save();

        session()->flash('success',_i('Add Succfully'));
        return redirect()->route('material_status.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'title' => 'required',
        ],[
            'title.required'=>_i('title required'),
        ]);

        $addMember =Material_status::findOrFail($request->id);
        $addMember->name = $request->title;
        $addMember->gender = $request->gender;
        $addMember->lang_id = $request->language;

        $addMember->save();

        session()->flash('success',_i('edited Succfully'));
        return redirect()->route('material_status.index');
    }

    public function destroy(Material_status $material_status)
    {

        $material_status = Material_status::findOrFail($material_status->id);

        $material_status->delete();
        session()->flash('success',_i('deleted Succfully'));
        return redirect()->route('material_status.index');
    }
}
