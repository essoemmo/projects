<?php


namespace App\Http\Controllers\Admin;


use App\DataTables\WorksOnDataTable;
use App\Http\Controllers\Controller;
use App\Models\SiteLanguage;
use App\Models\WorkOn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class WorksOnController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:WorkOn-Add'])->only('index');
        $this->middleware(['permission:WorkOn-Add'])->only('create');
        $this->middleware(['permission:WorkOn-Edit'])->only('edit');
        $this->middleware(['permission:WorkOn-Delete'])->only('delete');

    }

    public function index(WorksOnDataTable $worksDataTable)
    {
        return $worksDataTable->render('admin.works_on.index');
    }


    public function store(Request $request)
    {
        if ($request->ajax()){
            $work = WorkOn::create([
                'title'=>$request->title,
            ]);
            if ($request->hasFile('icon')) {
                $icon = $request->file('icon');
                $filename = time() . '.' . $icon->getClientOriginalExtension();
                $request->icon->move(public_path('uploads/works_on/'.$work->id), $filename);

                $work->icon = '/uploads/works_on/'. $work->id .'/'. $filename;
                $work->save();
            }
            //session()->put('success', _i('Added Successfully !'));
            return response()->json(true);
        }
    }


    public function update_work(Request $request, $id)
    {
        //dd($request->all());
        if ($request->ajax()) {
            //dd($request->title);
            $work = WorkOn::findOrFail($id);
            $work->update([
                'title' => $request->title,
            ]);
            if ($request->hasFile('icon')) {
                $image_path = $work->icon;  // Value is not URL but directory file path
                if (File::exists(public_path($image_path))) {
                    File::delete(public_path($image_path));
                }
                $icon = $request->file('icon');
                $filename = time() . '.' . $icon->getClientOriginalExtension();
                $request->icon->move(public_path('uploads/works_on/' . $work->id), $filename);

                $work->icon = '/uploads/works_on/' . $work->id . '/' . $filename;
                $work->save();
            }

            //session()->put('success', _i('Updated Successfully !'));
            return response()->json(true);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $work = WorkOn::findOrFail($id);
        $image_path = $work->icon;  // Value is not URL but directory file path
        if(File::exists(public_path($image_path))) {
            File::delete(public_path($image_path));
        }
        $work->delete();
        return back()->with('success','success delete');
    }

}
