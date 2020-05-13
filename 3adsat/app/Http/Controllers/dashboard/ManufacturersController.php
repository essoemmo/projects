<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class ManufacturersController extends Controller
{
    public $lang = "en_US";
    public $language_id;
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }


    public function index()
    {
        return view('admin.manufacturers.list');
    }


    public function getmanufacturersdatatable()
    {
        return Datatables::of(Manufacturer::select('*'))
            ->rawColumns(['actions'])
            ->editColumn('created_at', function ($rowData) {
                return $rowData->created_at->diffForHumans();
            })->editColumn('actions', function ($rowData) {
                $b = $this->button(route('manufacturers.edit', $rowData->id), 'primary mrs', 'pencil-alt');
//                $b .= $this->button(route('manufacturers.destroy', $rowData->id), 'danger destroy', 'trash');
                $b.='<form action="'.route('manufacturers-destroy', $rowData->id).'" method="delete" style="   display: inline-block; 
    right: 50px;
    bottom: 34px;" >
                        <butto class="btn btn-danger btn-sm delete"><i class="ti-trash"></i></butto>
                        </form>';
                return $b;
            })->make(true);
    }


    private function button(string $route, string $class, string $icon): string
    {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }


    public function create()
    {
        return view('admin.manufacturers.create');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048'
        ];
        $messages = [
            'name.required' => _i('Name is required'),
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $image = $request->file('image');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('images/manufacturers');
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0766, true);
                }
                $extension = $image->getClientOriginalExtension();
                $fileName = time().'_manufacturer.'.$extension;
                $image->move($destinationPath, $fileName);
                $input['image'] = $fileName;
            }

            $rowData = Manufacturer::create($input);
            $rowData->restore();

            session()->flash('success',_i('The manufacturer has been added successfully.'));
            return redirect()->route('manufacturers.edit', $rowData);

        }
    }


    public function edit($id)
    {
        $editData = Manufacturer::findOrFail($id);
        return view('admin.manufacturers.edit', compact('editData'));
    }

    public function update(Request $request, $id)
    {
        $rowData = Manufacturer::findOrFail($id);

        $input = $request->all();
        $rules = [
            'name' => 'required|string',
            'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048'
        ];
        $messages = [
            'name.required' => _i('Name is required'),
        ];

        $validator = Validator::make($input, $rules, $messages);
        if ($validator->fails()) {
            session()->flash('success',_i('There is a required field, please check again.'));
            return redirect()->route('manufacturers.edit', $rowData);
        } else {
            $image = $request->file('image');

            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('images/manufacturers');
                if (!is_dir($destinationPath)) {
                    mkdir($destinationPath, 0766, true);
                }
                $extension = $image->getClientOriginalExtension();
                $fileName = time().'_manufacturer.'.$extension;
                $image->move($destinationPath, $fileName);
                $input['image'] = $fileName;

                if(!empty($rowData->image)){
                    //delete old image
                    $file = public_path('images/manufacturers/').$rowData->image;
                    @unlink($file);
                }
            }
            $rowData->update($input);
            session()->flash('success',_i('The manufacturer has been correctly modified.'));
            return redirect()->route('manufacturers.edit', $rowData);

        }
    }


    public function destroy($id)
    {
        // Find the manufacturer by the ID
        $rowData = Manufacturer::find($id);
        // Find all the assigned products
        $assignedItemsNum = \App\Models\Product::where('manufacturer_id', $id)->count();
        if (!empty($assignedItemsNum)) {
            session()->flash('success',_i(' Warning: This manufacturer cannot be deleted as it is currently assigned to '.$assignedItemsNum.' products!'));
            return back();
        } else {
            $rowData->delete();
            session()->flash('success',_i('deleted succssfly'));
            return back();
        }
    }
}
