<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 11/07/2019
 * Time: 05:23 ã
 */

namespace App\Http\Controllers\Hr;


use App\Hr\Program;
use App\Hr\Program_volunteer;
use App\Hr\Volunteer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends  Controller
{

    public function index()
    {
        return view('admin.hr.volunteers.programs.index');
    }

    public function getDatatableVolunteerPrograms()
    {
        $programs = Program::select(['id','title','description','created_at','updated_at']);

        return DataTables::of($programs )
            ->addColumn('action', function ($p ) {
                return $this->generateHtmlEdit_Delete([$p->id,$p->title,$p->description],$p->id);
            })
            ->make(true);
    }

    public function add(Request $request)
    {
        $rules = [
            'title' => ['required', 'max:150','min:3', 'unique:programs'],
        ];

        $validator = validator()->make($request->all() , $rules);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $program = Program::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        $program->save();

        return redirect('/adminpanel/volunteer/program/all')->withFlashMessage(_i('Added Successfully !'));
    }

    public function update(Request $request)
    {
        $id = $request->input('id');
        $program= Program::findOrFail($id);

        $rules = [
            'title' => ['required', 'max:150','min:3', Rule::unique('programs')->ignore($program->id)],
        ];

        $validator = validator()->make($request->all() , $rules);

        if($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $program->title = $request->input('title');
        $program->description = $request->input('description');
        $program->save();
        return redirect('/adminpanel/volunteer/program/all')->withFlashMessage(_i('Updated Successfully !'));
    }

    public function delete(Request $request)
    {
        $id = $request->id;
        $program= Program::findOrFail($id);
        $program->delete();
        return redirect('/adminpanel/volunteer/program/all')->withFlashMessage(_i('Deleted Successully !'));
    }

    public function select_program()
    {
        $volunteers = Volunteer::all();
        $programs = Program::all();
        return view('admin.hr.volunteers.programs.select-program' , compact('volunteers' , 'programs'));
    }

    public function store_select_program(Request $request)
    {

        $volunteer_program = Program_volunteer::create([
            'volunteer_id' => $request->volunteer_id,
            'program_id' => $request->program_id,
            'created' => $request->created,
        ]);
        $volunteer_program->save();
        return redirect()->back()->withFlashMessage(_i('Added Successfully !'));
    }

    public function delete_volunteer_program($id)
    {
        $volunteer_program = Program_volunteer::findOrFail($id);
        $volunteer_program->delete();
        return redirect()->back()->withFlashMessage(_i('Deleted Successully !'));
    }



}