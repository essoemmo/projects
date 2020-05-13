<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Sphere;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class SphereController extends Controller
{
    public $lang = "en_US";
    public $language_id;

    /**
     * Create a new controller instance.
     */
    public function __construct() {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }

    public function index() {
        return view('admin.spheres.list');
    }

    public function getspheresdatatable()
    {
        return Datatables::of(Sphere::select('*')->orderby("id","desc"))
            ->rawColumns(['actions'])
            ->editColumn('actions', function ($rowData) {
                $b = $this->button(route('spheres.edit', $rowData->id), 'primary mrs', 'pencil-alt');
                $b.='<form action="'.route('spheres-destroy', $rowData->id).'" method="delete" style="    display: inline-block;
    right: 50px;
    bottom: 29px;" >
                        <butto class="btn btn-danger btn-sm delete"><i class="ti-trash"></i></butto>
                        </form>';
//                $b .= $this->button(route('spheres.destroy', $rowData->id), 'danger destroy', 'trash');
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

    private function button(string $route, string $class, string $icon): string
    {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }

    public function create()
    {
        return view('admin.spheres.create');
    }


    public function store(Request $request)
    {

//        dd($request->all());
        if($request->type == 1) {
            $this->validate($request,[
                'title_colored' => 'required|string|min:2',
                'price_colored' => 'required',
                'type' => 'required',
            ]);
            $sphere = new Sphere();
            $sphere->title = $request->input('title_colored');
            $sphere->price = $request->input('price_colored');
            $sphere->type = $request->input('type');

            $sphere->save();
            session()->flash('success',_i('The page has been added successfully.'));
            return redirect()->route('spheres.edit', $sphere);
        } elseif($request->type == 2) {
            $this->validate($request,[
                'title_trans' => 'required|string|min:2',
                'price_trans' => 'required',
                'type' => 'required',
            ]);
            $sphere = new Sphere();
            $sphere->title = $request->input('title_trans');
            $sphere->price = $request->input('price_trans');
            $sphere->type = $request->input('type');

            $sphere->save();

            session()->flash('success',_i('The page has been added successfully.'));
            return redirect()->route('spheres.edit', $sphere);
        }
    }

    public function edit($id)
    {
        $sphere = Sphere::findOrFail($id);
        return view('admin.spheres.edit', compact('sphere'));
    }

    public function update(Request $request, $id)
    {
        $sphere = Sphere::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|string|min:2',
            'price' => 'required',
        ]);

        $sphere->title = $request->input('title');
        $sphere->price = $request->input('price');

        $sphere->save();
        session()->flash('success',_i('The page has been correctly modified.'));
        return redirect()->route('spheres.edit', $sphere);

    }

    public function destroy($id)
    {
        $rowData = Sphere::find($id);
        session()->flash('success',_i('deleted successfly'));
        $rowData->delete();
        return back();
    }



}
