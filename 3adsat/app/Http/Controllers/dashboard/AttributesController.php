<?php

namespace App\Http\Controllers\dashboard;

use App\Models\AttributeGroup;
use App\Models\AttributeGroupDescription;
use App\Models\Language;
use App\Models\PrAttribute;
use App\Models\PrAttributeDescription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AttributesController extends Controller
{
    public $lang = "en";
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
        return view('admin.attributes.list');
    }


    public function getattributedatatable()
    {
        return Datatables::of(PrAttribute::select('*'))
            ->rawColumns(['actions', 'status'])
            ->editColumn('name', function ($rowData) {
                //select fields by language_id
                $rowTranslation =  PrAttributeDescription::getOneByIdAndLanguage($rowData->id, $this->language_id);
                if (!empty($rowTranslation->name)) {
                    return $rowTranslation->name;
                }
                return "";
            })->editColumn('created_at', function ($rowData) {
                return $rowData->created_at->diffForHumans();
            })->editColumn('attributeGroupName', function ($rowData) {

                $attributeGroupName = AttributeGroupDescription::getOneByIdAndLanguage($rowData->attribute_group_id, $this->language_id);

                if (!empty($attributeGroupName->name)) {
                    return $attributeGroupName->name;
                }
                return "";
            })->editColumn('status', function ($rowData) {
                if ($rowData->status == 0) {
                    return '<span class="label label-success">'._i('Enabled').'</span>';
                }
                return '<span class="label label-danger">'._i('Disabled').'</span>';
            })->editColumn('actions', function ($rowData) {
                $b = $this->button(route('attributes.edit', $rowData->id), 'primary mrs', 'pencil-alt');
                $b.='<form action="'.route('attribute-destroy', $rowData->id).'" method="delete" style="   
    right: 50px;
    bottom: 29px;  display: inline-block; " >
                        <button class="btn btn-danger btn-sm delete"><i class="ti-trash"></i></button>
                        </form>';
                return $b;
            })->make(true);
    }

    /**
     * Get html button for datatable.
     *
     * @param string $route
     * @param string $class
     * @param string $icon
     *
     * @return string
     */
    private function button(string $route, string $class, string $icon): string
    {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::getEnabledLanguages();
        $attributeGroups = AttributeGroup::getByLanguage($this->language_id);
        return view('admin.attributes.create', ['attributeGroups' => $attributeGroups, 'languages' => $languages]);
    }

    /**
     * Store a newly created user in storage.
     *
     * @param Request $request
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
            'attribute_group_id' => 'required'
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
            'attribute_group_id.required' => _i('Attribute Group is required')
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            try {
                $row = new PrAttribute();

                $row->attribute_group_id = $input['attribute_group_id'];
                $row->sort_order = $input['sort_order'];
                $row->status = $input['status'];

                $row->save();
                //get the last inserted id
                $rowId = $row->id;
                if (!empty($rowId)) {
                    $rowData = PrAttribute::latest()->first();
                    foreach($input['name'] as $key => $value)
                    {
                        $rowTranslation = new PrAttributeDescription();
                        $rowTranslation->pr_attribute_id = $rowId;
                        $rowTranslation->language_id = $key;
                        $rowTranslation->name = $value;

                        $rowTranslation->save();
                    }
                }

                $rowData->restore();

                session()->flash('success',_i('The attribute has been added successfully.'));
                return redirect()->route('attributes.edit', $rowData);
            } catch (Exception $e) {
                session()->flash('success',_i('There was an error, please try again.'));
                return redirect()->route('attributes.create');
            }
        }
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rowData = PrAttribute::findOrFail($id);
        $languages = Language::getEnabledLanguages();
        $attributeGroups = AttributeGroup::getByLanguage($this->language_id);
        // $row = new PrAttribute();
        // $rowTranslation = PrAttribute::with(['hasDescription' => function ($query) use ($id) {
        //     $query->where('pr_attribute_id', '=', $id);
        // }])->get();
        // $rowTranslation = PrAttributeDescription::with('attribute')->get();

        // foreach ($rowTranslation as $key => $post){
        //   $languageIds = $post->get_hasDescription()->pluck('language_id')->toArray();
        // }

        $rowTranslation = PrAttributeDescription::getAllById($id);
        $languageIds = $rowTranslation->pluck('language_id')->toArray();
        return view('admin.attributes.edit', compact('rowData', 'rowTranslation', 'languages', 'languageIds', 'attributeGroups'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param Request $request
     * @param $id
     *
     * @throws \Illuminate\Validation\ValidationException
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rowData = PrAttribute::findOrFail($id);

        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
            'attribute_group_id' => 'required'
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
            'attribute_group_id.required' => _i('Attribute Group is required')
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            session()->flash('success',_i('There is a required field, please check again.'));
            return redirect()->route('attributes.edit', $attribute);
        } else {

            try {
                $rowData->attribute_group_id = $input['attribute_group_id'];
                $rowData->sort_order = $input['sort_order'];
                $rowData->status = $input['status'];

                $rowData->save();
                foreach($input['name'] as $key => $value)
                {
                    $transId = $input['id'][$key];
                    if(!empty($transId)) { //if this is an existing translation, update it
                        $rowTranslation = PrAttributeDescription::find($transId);
                    } else {
                        //insert new translation
                        $rowTranslation = new PrAttributeDescription();
                    }

                    $rowTranslation->pr_attribute_id = $id;
                    $rowTranslation->language_id = $key;
                    $rowTranslation->name = $value;
                    $rowTranslation->save();
                }
                session()->flash('success',_i('The attribute has been correctly modified.'));
                return redirect()->route('attributes.edit', $rowData);
            } catch (Exception $e) {
                session()->flash('success',_i('An error occurred, please try again.'));
                return redirect()->route('attributes.edit', $rowData);
            }
        }
    }


    public function destroy($id)
    {
        // Find the item by the ID
        $rowData = PrAttribute::find($id);

        // Find all the assigned products
        $assignedItemsNum = \App\Models\ProductAttribute::where('pr_attribute_id', $id)->count();
        if (!empty($assignedItemsNum)) {
            return _i(' Warning: This attribute cannot be deleted as it is currently assigned to '.$assignedItemsNum.' products!');
        } else {
            // Delete the item
            $rowData->delete();
            //delete all associated rows in other tables
            PrAttributeDescription::where('pr_attribute_id',$id)->delete();
            session()->flash('success',_i('An error occurred, please try again.'));

            return back();
        }
    }
}
