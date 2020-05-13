<?php

namespace App\Http\Controllers\dashboard;

use App\Models\CategoryDescription;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class categoriesController extends Controller
{
    public $lang = "en_US";
    public $language_id;


    public function __construct() {

        $this->middleware(function ($request, $next) {
            // fetch session and use it in entire class with constructor
            $this->language_id = checknotsessionlang();

            return $next($request);
        });
    }

    public function index() {

        return view('admin.categories.list');
    }

    public function datatable() {
        return Datatables::of(Category::select('*'))
            ->rawColumns(['actions', 'status', "parent"])
            ->editColumn('name', function ($rowData) {
                //select fields by language_id
                $rowTranslation = CategoryDescription::getOneByIdAndLanguage($rowData->id, $this->language_id);
                if (!empty($rowTranslation->name)) {
                    return $rowTranslation->name;
                }
                return "";
            })
            ->editColumn('created_at', function ($rowData) {
                return $rowData->created_at->diffForHumans();
            })->editColumn('status', function ($rowData) {
                if ($rowData->status == 0) {
                    return '<span class="label label-success">' . _i('Enabled') . '</span>';
                }
                return '<span class="label label-danger">' . _i('Disabled') . '</span>';
            })->editColumn('parent', function ($rowData) {
                return $this->getTree($rowData->parent_id);
            })

            ->editColumn('actions', function ($rowData) {
                $b = $this->button(route('categories.edit', $rowData->id), 'primary btn-sm mrs', 'pencil-alt');
                $b.='<form action="'.route('categories-destroy', $rowData->id).'" method="delete"
 style="  
    display: inline-block; 
    right: 50px;
    bottom: 34px;
    " >
                        <butto class="btn btn-danger btn-sm delete"><i class="ti-trash"></i></butto>
                        </form>';

                return $b;
            })->make(true);
    }

    private function getTree($id) {
        if ($id == null)
            return;
        $categoryDescription = CategoryDescription::where("category_id", "=", $id)->first();
        $category = Category::find($id);
        if ($category->parent_id !== null)
            return $this->getTree($category->parent_id) ." -> ". $categoryDescription->name;
        return $categoryDescription->name;

    }

    private function button(string $route, string $class, string $icon): string {
        return sprintf('<a href="%s" class="btn btn-sm btn-%s"><i class="ti-%s"></i></a>', $route, $class, $icon);
    }


    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $categories = Category::all();
        $languages = Language::getEnabledLanguages();


        // $categories = Category::tree()->siblingsAndSelf()->depthFirst()->get();
        // $categories = Category::find(1)->descendantsAndSelf()->depthFirst()->get();
        // $categories = Category::all()->descendantsAndSelf()->depthFirst()->get();
        // if (!empty($categories)) {
        //     foreach ($categories as $item) {
        //     $descendants = Category::find($item->id)->descendantsAndSelf()->depthFirst()->get();
        //     if (!empty($descendants)) {
        //         foreach ($descendants as $item2) {
        //             $path =
        //             $item2->path = $item[]
        //         }
        //     }
        //   }
        // }
        return view('admin.categories.create', ['categories' => $categories, 'languages' => $languages, 'language_id' => $this->language_id]);
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
    public function store(Request $request) {
        // $input = $request->except('_token');
        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
            'meta_title.*' => 'required|string|min:2',
            // 'image' => 'required|image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048'
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
            'meta_title.*.required' => _i('Meta Title is required'),
            'meta_title.*.min' => _i('The Meta Title must be at least :min characters.'),
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            try {

                $categoryInput = array();

                $categoryInput = Input::except('name', 'description', 'meta_title', 'meta_description', 'meta_keyword');

                if ($categoryInput['parent_id'] == 0) {
                    $categoryInput['parent_id'] = NULL;
                }

                // //upload the image
                // $image = $request->file('image');
                // $fileName = "";
                // if ($image && $file = $image->isValid()) {
                //     $destinationPath = public_path('images/categories');
                //     if (!is_dir($destinationPath)) {
                //         mkdir($destinationPath, 0766, true);
                //     }
                //     $extension = $image->getClientOriginalExtension();
                //     $fileName = time().'_category.'.$extension;
                //     $image->move($destinationPath, $fileName);
                //     $categoryInput['image'] = $fileName;
                // }

                $rowData = Category::create($categoryInput);
//                dd($rowData);
                $rowData->restore();
                //get the last inserted id
                $rowId = $rowData->id;
                if (!empty($rowId)) {
                    //insert translations
                    foreach ($input['name'] as $key => $value) {
                        $rowTranslation = new CategoryDescription();
                        $rowTranslation->category_id = $rowId;
                        $rowTranslation->language_id = $key;
                        $rowTranslation->name = $value;
                        $rowTranslation->description = $input['description'][$key];
                        $rowTranslation->meta_title = $input['meta_title'][$key];
                        $rowTranslation->meta_description = $input['meta_description'][$key];
                        $rowTranslation->meta_keyword = $input['meta_keyword'][$key];

                        $rowTranslation->save();
                    }
                }
                $rowData->restore();
                    session()->flash('success',_i('The category has been added successfully'));
                return redirect()->route('categories.edit', $rowData)
                    ->with('growl', [_i('The category has been added successfully.'), 'success']);
            } catch (Exception $e) {
                session()->flash('success',_i('There was an error, please try again'));
                return redirect()->route('categories.create')->with('growl', [_i('There was an error, please try again.'), 'error']);
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
    public function edit($id) {
        $rowData = Category::findOrFail($id);

        $categories = Category::all();
        $languages = Language::getEnabledLanguages();

        $rowTranslation = CategoryDescription::getAllById($id);

        $languageIds = $rowTranslation->pluck('language_id')->toArray();

        $language_id = $this->language_id;

        return view('admin.categories.edit', compact('rowData', 'rowTranslation', 'languages', 'languageIds', 'categories', 'language_id'));
    }


    public function update(Request $request, $id) {
        $rowData = Category::findOrFail($id);

        $input = $request->all();
        $rules = [
            'name.*' => 'required|string|min:2',
            'meta_title.*' => 'required|string|min:2',
            // 'image' => 'image|mimes:jpeg,jpg,png,bmp,gif,svg|max:2048'
        ];
        $messages = [
            'name.*.required' => _i('Name is required'),
            'name.*.min' => _i('The Name must be at least :min characters.'),
            'meta_title.*.required' => _i('Meta Title is required'),
            'meta_title.*.min' => _i('The Meta Title must be at least :min characters.'),
        ];

        $validator = Validator::make($input, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('categories.edit', $rowData)
                ->with('growl', [_i('There is a required field, please check again.'), 'error'])->withErrors($validator)->withInput();
        } else {
            try {

                $categoryInput = array();

                $categoryInput = Input::except('name', 'description', 'meta_title', 'meta_description', 'meta_keyword');

                if ($categoryInput['parent_id'] == 0) {
                    $categoryInput['parent_id'] = NULL;
                }

                //      //Image
                // $image = $request->file('image');
                // $fileName = $rowData->image;
                // if ($image && $file = $image->isValid()) {
                //     $destinationPath = public_path('images/categories');
                //     if (!is_dir($destinationPath)) {
                //         mkdir($destinationPath, 0766, true);
                //     }
                //     $extension = $image->getClientOriginalExtension();
                //     $fileName = time().'_category.'.$extension;
                //     $image->move($destinationPath, $fileName);
                //     $categoryInput['image'] = $fileName;
                //     if(!empty($rowData->image)){
                //         //delete old image
                //         $file = public_path('images/categories/').$rowData->image;
                //         @unlink($file);
                //     }
                // }

                $rowData->update($categoryInput);

                //Translations
                foreach ($input['name'] as $key => $value) {
                    $transId = $input['id'][$key];
                    if (!empty($transId)) { //if this is an existing translation, update it
                        $rowTranslation = CategoryDescription::find($transId);
                    } else {
                        //insert new translation
                        $rowTranslation = new CategoryDescription();
                    }

                    $rowTranslation->category_id = $id;
                    $rowTranslation->language_id = $key;
                    $rowTranslation->name = $value;
                    $rowTranslation->description = $input['description'][$key];
                    $rowTranslation->meta_title = $input['meta_title'][$key];
                    $rowTranslation->meta_description = $input['meta_description'][$key];
                    $rowTranslation->meta_keyword = $input['meta_keyword'][$key];
                    $rowTranslation->save();
                }
                session()->flash('success',_i('The category has been correctly modified.'));
                return redirect()->route('categories.edit', $rowData);
            } catch (Exception $e) {
                session()->flash('success',_i('An error occurred, please try again.'));
                return redirect()->route('categories.edit', $rowData);
            }
        }
    }

    public function destroy($id) {
        // Find the category by the ID
        $rowData = Category::find($id);


        // Find all the assigned subcategories
        $childCatgoresNum = Category::where('parent_id', $id)->count();
        $productsNum = \App\Models\ProductCategory::where('category_id', $id)->where('deleted_at', NULL)->count();
        if (!empty($childCatgoresNum)) {
            session()->flash('success',_i(' Warning: This category cannot be deleted as it is currently assigned to ' . $childCatgoresNum . ' child categories!'));
            return back();
        } else if (!empty($productsNum)) {
            session()->flash('success',_i(' Warning: This category cannot be deleted as it is currently assigned to ' . $productsNum . ' products!'));
            return back();
        } else {
            // Delete the category
            session()->flash('success',_i('deleted successfly'));
            $rowData->delete();
            return back();
        }
    }
}
