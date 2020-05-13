<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Axis;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class AxisController extends Controller
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

    public function index()
    {
        return view('admin.axis.list');
    }


    private function button(string $route, string $class, string $icon): string
    {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }

    public function getaxisdatatable()
    {
        return Datatables::of(Axis::select('*'))
            ->rawColumns(['actions','type'])
            ->editColumn('actions', function ($rowData) {
                $b = $this->button(route('axis.edit', $rowData->id), 'primary mrs', 'pencil-alt');
                $b.='<form action="'.route('axis-destroy', $rowData->id).'" method="delete" style="     display: inline-block;
    right: 50px;
    bottom: 29px;" >
                        <button class="btn btn-danger btn-sm delete"><i class="ti-trash"></i></button>
                        </form>';
                return $b;
            })
            ->addColumn('type', function ($query) {
                if($query->type == 1) {
                    return '<span class="btn btn-success">'._i('Colored').'</span>';
                } elseif ($query->type == 2) {
                    return '<span  class="btn btn-success">'._i('Transparent').'</span>';
//                    return _i('Transparent');
                }
            })
            ->make(true);
    }



    public function create()
    {
        return view('admin.axis.create');
    }


    public function store(Request $request)
    {
        if($request->type == 1) {
            $this->validate($request,[
                'title_colored' => 'required|string|min:2',
                'price_colored' => 'required',
                'type' => 'required',
            ]);
            $axis = new Axis();
            $axis->title = $request->input('title_colored');
            $axis->price = $request->input('price_colored');
            $axis->type = $request->input('type');

            $axis->save();

            session()->flash('success',_i('The page has been added successfully.'));
            return redirect()->route('axis.edit', $axis);
        } elseif($request->type == 2) {
            $this->validate($request,[
                'title_trans' => 'required|string|min:2',
                'price_trans' => 'required',
                'type' => 'required',
            ]);
            $axis = new Axis();
            $axis->title = $request->input('title_trans');
            $axis->price = $request->input('price_trans');
            $axis->type = $request->input('type');

            $axis->save();
            session()->flash('success',_i('The page has been added successfully.'));
            return redirect()->route('boilerplate.axis.edit', $axis);
        }
    }


    public function edit($id)
    {
        $axis = Axis::findOrFail($id);
        return view('admin.axis.edit', compact('axis'));
    }


    public function update(Request $request, $id)
    {
        $axis = Axis::findOrFail($id);
        $this->validate($request,[
            'title' => 'required|string|min:2',
            'price' => 'required',
        ]);

        $axis->title = $request->input('title');
        $axis->price = $request->input('price');

        $axis->save();
            session()->flash('success',_i('The page has been correctly modified.'));
        return redirect()->route('axis.edit', $axis);

    }

    public function destroy($id)
    {
        $rowData = Axis::find($id);
        $rowData->delete();
        session()->flash('success',_i('deletd succefly'));
        return back();
    }
}
