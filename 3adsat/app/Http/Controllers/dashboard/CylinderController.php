<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Cylinder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class CylinderController extends Controller
{

    public $lang = "en_US";
    public $language_id;

    public function index()
    {
        return view('admin.cylinder.list');
    }


    public function __construct() {

        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }

    private function button(string $route, string $class, string $icon): string
    {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }

    public function getcylinderdatatable()
    {
        return Datatables::of(Cylinder::select('*'))
            ->rawColumns(['actions'])
            ->editColumn('actions', function ($rowData) {
                $b = $this->button(route('cylinder.edit', $rowData->id), 'primary mrs center', 'pencil-alt');
//                $b .= $this->button(route('cylinder.destroy', $rowData->id), 'danger destroy', 'trash');
                $b.='<form action="'.route('cylinder-destroy', $rowData->id).'" method="delete" style="    display: inline-block;
    right: 50px;
    bottom: 29px;" >
                        <butto class="btn btn-danger btn-sm delete "><i class="ti-trash"></i></butto>
                        </form>';
                return $b;
            })
            ->addColumn('type', function ($query) {
                if($query->type == 1) {
                    return _i('Colored');
                } elseif ($query->type == 2) {
                    return _i('Transparent');
                }
            })
            ->make(true);
    }

    public function create()
    {
        return view('admin.cylinder.create');
    }

    public function store(Request $request)
    {
        if($request->type == 1) {
            $this->validate($request,[
                'title_colored' => 'required|string|min:2',
                'price_colored' => 'required',
                'type' => 'required',
            ]);
            $cylinder = new Cylinder();
            $cylinder->title = $request->input('title_colored');
            $cylinder->price = $request->input('price_colored');
            $cylinder->type = $request->input('type');

            $cylinder->save();

            session()->flash('success',_i('The page has been added successfully.'));
            return redirect()->route('cylinder.edit', $cylinder);
        } elseif($request->type == 2) {
            $this->validate($request,[
                'title_trans' => 'required|string|min:2',
                'price_trans' => 'required',
                'type' => 'required',
            ]);
            $cylinder = new Cylinder();
            $cylinder->title = $request->input('title_trans');
            $cylinder->price = $request->input('price_trans');
            $cylinder->type = $request->input('type');

            $cylinder->save();

            session()->flash('success',_i('The page has been added successfully.'));
            return redirect()->route('cylinder.edit', $cylinder);
        }
    }

    public function edit($id)
    {
        $cylinder = Cylinder::findOrFail($id);
        return view('admin.cylinder.edit', compact('cylinder'));
    }

    public function update(Request $request, $id)
    {

        $cylinder = Cylinder::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|string|min:2',
            'price' => 'required|string|min:2',
        ]);

        $cylinder->title = $request->input('title');
        $cylinder->price = $request->input('price');

        $cylinder->save();

        session()->flash('success',_i('The page has been correctly modified.'));
        return redirect()->route('cylinder.edit', $cylinder);
    }


    public function destroy($id)
    {
        $rowData = Cylinder::find($id);
        $rowData->delete();
        session()->flash('success',_i('The deleted succeffly.'));

        return back();
    }


}
