<?php

namespace App\Http\Controllers\dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lens;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class LensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.lens.index');
    }
    private function button(string $route, string $class, string $icon): string
    {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }

    public function getaxisdatatable()
    {
        return DataTables::eloquent(Lens::query())
            ->addColumn('actions', function (Lens $rowData) {
                $b = $this->button(route('lens.edit', $rowData->id), 'primary mrs', 'pencil-alt');
                $b .= '<form action="' . route('lens-destroy', $rowData->id) . '" method="delete" style="display: inline;
            right: 50px;
            bottom: 29px;" >
                <button class="btn btn-danger btn-sm delete"><i class="ti-trash"></i></button>
                </form>';
                return $b;
            })
            ->rawColumns(['actions'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return \view('admin.lens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:45'],
            'sub_name' => ['max:45'],
            'description' => ['max:200'],
            'image' => ['image', 'max:3000'],
        ]);
        
        $lens = Lens::create($request->except(['image']));
        if ($request->hasFile('image')) {
            $lens->image = $request->image->store('lens', 'public_uploads');
        }
        $lens->save();
        return Redirect::route('lens.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lens = Lens::find($id);
        return \view('admin.lens.edit', ['lens' => $lens]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id'=>['exists:tbl_lenses,id'],
            'name' => ['required', 'max:45'],
            'sub_name' => ['max:45'],
            'description' => ['max:200'],
            'image' => ['image', 'max:3000'],
        ]);


        $lens = Lens::find($id);
        $lens->fill($request->except(['image']));
        if ($request->hasFile('image')) {
            $lens->image = $request->image->store('lens', 'public_uploads');

        }
        $lens->save();
       return Redirect::route('lens.edit',['len'=>$lens->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lens = Lens::find($id);
        $lens->delete();
        return Redirect::route('lens.index');
    }
}
