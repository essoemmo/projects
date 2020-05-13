<?php

namespace App\Http\Controllers\dashboard;

use App\Models\Attribute;
use App\Models\AttributeGroup;
use App\Models\AttributeGroupDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AttributeGroupController extends Controller
{
    public $lang = "en";
    public $language_id;


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
        return view('admin.attributegroups.list');
    }


    public function getattributegroupsdatatable()
    {
        return Datatables::of(AttributeGroup::select('*'))
            ->rawColumns(['actions', 'status'])
            ->editColumn('name', function ($rowData) {
                //select fields by language
                $rowTranslation =  DB::table('attribute_group_descriptions')
                    ->where('attribute_group_id', $rowData->id)
                    ->where('language_id', '=', checknotsessionlang())
                    ->where('deleted_at', '=', NULL)
                    ->select('name')
                    ->first();
//                dd($rowData,$rowTranslation);
                return $rowTranslation->name;
            })->editColumn('created_at', function ($rowData) {
                return $rowData->created_at->diffForHumans();
            })->editColumn('status', function ($rowData) {
                if ($rowData->status == 0) {
                    return '<span class="label label-success">' . _i('Enabled') . '</span>';
                }
                return '<span class="label label-danger">' . _i('Disabled') . '</span>';
            })
            ->addColumn('actions', 'admin.attributegroups.btn.delete')
            ->make(true);
    }


    private function button(string $route, string $class, string $icon)
    {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }

    public function create()
    {
        $languages = DB::table('languages')->where([
            ['status', '=', 0],
            ['deleted_at', '=', NULL],
        ])->get();
        return view('admin.attributegroups.create', ['languages' => $languages]);
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            try {
                $row = new AttributeGroup();

                $row->sort_order = $input['sort_order'];
                $row->status = $input['status'];

                $row->save();
                //get the last inserted id
                $rowId = $row->id;
                if (!empty($rowId)) {
                    $rowData = AttributeGroup::latest()->first();
                    foreach($input['name'] as $key => $value)
                    {
                        $rowTranslation = new AttributeGroupDescription();
                        $rowTranslation->attribute_group_id = $rowId;
                        $rowTranslation->language_id = $key;
                        $rowTranslation->name = $value;

                        $rowTranslation->save();
                    }
                }
                $rowData->restore();

                session()->flash('success',_i('The attribute group has been added successfully.'));
                return redirect()->route('attributegroups.edit', $rowData);
            } catch (Exception $e) {
                session()->flash('success',_i('There was an error, please try again.'));
                return redirect()->route('attributegroups.create');
            }
        }
    }


    public function edit($id)
    {
        $languages = DB::table('languages')->where([
            ['status', '=', 0],
            ['deleted_at', '=', NULL],
        ])->get();

        $rowData = AttributeGroup::findOrFail($id);
        $rowTranslation = AttributeGroupDescription::where([
            ['deleted_at', '=', NULL],
            ['attribute_group_id', '=', $id],
        ])->get();
        // $translationTable = "attribute_group_descriptions";
        // $rowTranslation = DB::table($translationTable)
        //     ->join('languages', 'languages.id', '=', $translationTable.'.language_id')
        //     ->select($translationTable.'.*', 'languages.name as lang_name', 'languages.image as lang_image')
        //     ->where([
        //             [$translationTable.'.deleted_at', '=', NULL],
        //             [$translationTable.'.attribute_group_id', '=', $id],
        //            ])
        //     ->get();

        $languageIds = $rowTranslation->pluck('language_id')->toArray();

        return view('admin.attributegroups.edit', compact('rowData', 'rowTranslation', 'languages', 'languageIds'));
    }


    public function update(Request $request, $id)
    {
        $rowData = AttributeGroup::findOrFail($id);

        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            session()->flash('success',_i('There is a required field, please check again.'));
            return redirect()->route('attributegroups.edit', $rowData);

            // return redirect()->back()->withErrors($validator)->withInput();
        } else {
            try {
                $rowData->sort_order = $input['sort_order'];
                $rowData->status = $input['status'];

                $rowData->save();
                foreach($input['name'] as $key => $value)
                {
                    $transId = $input['id'][$key];
                    if(!empty($transId)) { //if this is an existing translation, update it
                        $rowTranslation = AttributeGroupDescription::find($transId);
                    } else {
                        //insert new translation
                        $rowTranslation = new AttributeGroupDescription();
                    }

                    $rowTranslation->attribute_group_id = $id;
                    $rowTranslation->language_id = $key;
                    $rowTranslation->name = $value;
                    $rowTranslation->save();
                }
                session()->flash('success',_i('The attribute group has been correctly modified.'));
                return redirect()->route('attributegroups.edit', $rowData);

            } catch (Exception $e) {
                session()->flash('success',_i('An error occurred, please try again.'));
                return redirect()->route('attributegroups.edit', $rowData);
            }
        }
    }


    public function destroy($id)
    {
        // Find the group by the ID
        $rowData = AttributeGroup::find($id);

        // Find all the assigned atttributes
        $assignedItemsNum = DB::table('pr_attributes')->where('attribute_group_id', $id)->count();
        if (!empty($assignedItemsNum)) {
            session()->flash('success',_i(' Warning: This attribute group cannot be deleted as it is currently assigned to '.$assignedItemsNum.' attributes!'));
            return back();
        } else {
            // Delete the group
            $rowData->delete();
            //delete all associated rows in other tables
            AttributeGroupDescription::where('attribute_group_id',$id)->delete();
            session()->flash('success',_i('deleted succssfly'));
            return back();
        }
    }
}
