<?php
/**
 * Created by PhpStorm.
 * User: misr computer
 * Date: 21/07/2019
 * Time: 03:37 �
 */

namespace App\Http\Controllers\Admin\category;


use App\Help\Utility;
use App\Models\product\stores;
use function foo\func;
use Ut;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class CategoryController extends  Controller
{

    public function all()
    {
        return view('admin.category.all');
    }

// make datatable for category
    public function  getDatatableCategory()
    {
        
        $store = stores::where('id',session()->get('StoreId'))->first();
        $categories = Category::select(['id', 'title', 'description','number','store_id', 'parent_id', 'language_id', 'source_id','created_at'])
            ->where('parent_id' ,'=' , null)
            ->where('store_id','=',$store->id);

        return DataTables::of($categories)
            ->addColumn('action', function ($categories) {
                return'<a href="'.$categories->id.'/edit" class="btn btn-icon waves-effect waves-light btn-primary" title="'._i("Edit").'"><i class="ti-pencil-alt"></i> </a>' ."&nbsp;&nbsp;&nbsp;".
                '<a href="'.$categories->id.'/delete" class="btn btn-icon waves-effect waves-light btn-danger" title="'._i("Delete").'"><i class="ti-trash"></i> </a>';
            })
            ->make(true);
    }

    public function create()
    {
        $categories = Category::whereNull('source_id')->where('store_id', \App\Bll\Utility::getStoreId())->whereNull("parent_id")->orderBy('number', 'asc')->get();

        return view('admin.category.create',compact('categories'));
    }

    public function store(Request $request)
    {
      
       
        if ($request->ajax()){
                $categoryExists = Category::where('store_id',$request->store)->exists();
//                if (!$categoryExists){
//                    dd($request->store);
////                    if there are no store id
//                }else{
                    $data = $request->data;
                    $i = '';
                    $y = 1;
                    $cat_id = ''; 
                    foreach ($data as $key => $d){
                        if ($key != 0){
                            $collectId = explode('-',$d['name']);
                            if ($collectId[0] == 'newparent'){
                                $cat_count = Category::where('parent_id',null)->count();
                                if ($d['value'] != null){
                                    $cat_id = Category::create(['title'=> $d['value'],'number'=>$cat_count + 1,'store_id'=>$request->store,'parent_id'=>null]);
                                }
                            }elseif($collectId[0] == 'newchild'){
                                $sub_cat_stores = Category::where('id' ,$cat_id ? $cat_id->id : $collectId[1])->first();
                                $sub_cat_count = $sub_cat_stores->children != null ? count($sub_cat_stores->children): 0;
                                    if ($d['value'] != null){
                                        Category::create(['title'=> $d['value'],'number'=>$sub_cat_count + 1,'store_id'=>$request->store,'parent_id'=>$cat_id ? $cat_id->id : $collectId[1]]);
                                    }
                            }else{
                                if ($collectId[0] == 'parent'){
                                    $i = 1;
                                    $sub_cat_stores = Category::where('id' ,$collectId[1])->first();
                                    $sub_cat_stores->update(['title'=>$d['value'],'number'=>$y++]);
                                }else{
                                    $sub_categories = Category::where('id' ,$collectId[1])->first();
                                    $sub_categories->update(['title'=>$d['value'],'number'=>$i++]);
                                }
                            }

                        }
                    }
                    $categories = Category::where('parent_id','=',null)->where('store_id',$request->store)->orderBy('number','asc')->with(['children' => function($query){
                        $query->orderBy('number','asc');
                    }])->get();
                    return $categories;
              //  }
        }else{

        //'title', 'description','number','store_id', 'parent_id', 'language_id', 'source_id'
        $rules = [
            'category' => 'required|max:150|unique:categories,title',
            'sub_category' => 'required|max:150',
        ];

        $validator = validator()->make($request->all() ,$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{

//            $guard_store = Utility::Store;
            $categories = $request->category;
            $store = stores::where('id',session()->get('StoreId'))->first();

            foreach($categories  as  $key => $category)
            {
                $cat = Category::create([
                    'title' => $category,
                    'number' => $key,
                'store_id' => $store->id,
                ]);
                $cat->save();

                $sub_categories = $request->sub_category;
//            dd($sub_categories[$key]);
                foreach($sub_categories[$key] as $key_sub => $sub_category)
                {
                    $cat_id = $cat->id;
//                    $rules['sub_category'] = ['unique:categories,parent_id'.$cat_id];
                    $rules['sub_category'] = Rule::unique('categories,title')->where('parent_id',$cat_id); // check if sub category title unique for parent category
                    $sub_cat = Category::create([
                        'title' => $sub_category,
                        'number' => $key_sub,
                        'parent_id' => $cat_id,
//                    'store_id' => auth()->guard($guard_store)->user()->id,
                    ]);
                    $sub_cat->save();
                }// end foreach => sub category
            } // end foreach => category

            return redirect()->back()->with('flash_message' , _i('Added Successfully !'));
        } // end else

        }
    }

    public function edit($cat_id)
    {
        $category = Category::findOrFail($cat_id);
        $sub_categories = Category::where('parent_id', $category->id)->get();
        $count = count($sub_categories);
        return view('admin.category.edit' ,compact('category','sub_categories','count'));
    }

    public function update($cat_id , Request $request)
    {
        //dd($request->sub_category[1][1]);
        $category = Category::findOrFail($cat_id); // return category
        $sub_cat_store = Category::where('parent_id' ,$category->id)->get();
        $store_data = count($sub_cat_store); // return count of store sub category that belongs to category
        $sub_categories = $request->sub_category;
        $req_data = count($sub_categories[1]); // return count of  request sub category
        if(count($sub_categories[1]) + 1 > count($sub_cat_store)) // check if request of request(sub categories) is bigger than sub categories stores to category
        {
            for($i = $store_data+1; $i <= $req_data  ;$i++)
            {
                $sub_cat = Category::create([
                    'title' => $request->sub_category[1][$i],
                    'number' => $i,
                    'parent_id' => $cat_id,
                    'store_id' => session('StoreId'),
                ]);
                $sub_cat->save();
            }
        }else {

//        dd($request->sub_category[1]);
//        dd($request->sub_category_id[1][1]);
            $sub_cat_ids = $request->sub_category[1]; // return sub categories that belongs category(edit)
            foreach ($sub_cat_ids as $key => $sub_cat_id) {
                $sub_category_old_store = Category::findOrFail($sub_cat_id); // find sub category store by id => input hidden
                $sub_category_old_store->title = $request->sub_category[1][$key]; // update value of sub category store with value of request that (contain same (number =>field in db))
                $sub_category_old_store->save();
            }
        }
        return redirect()->back()->with('flash_message' , _i('Updated Successfully !'));
    }

    public function delete($cat_id)
    {
        $category = Category::findOrFail($cat_id);
        if($category)
        {
            $sub_categories = Category::where('parent_id', $category->id)->get();
            foreach($sub_categories as $sub_cat)
            {
                $sub_cat->delete();
            }

            $category->delete();
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully !'));
        }else{
            return redirect()->back()->with('flash_message' , _i('Not Found !'));
        }
    }

    public function delete_sub_category($sub_cat_id)
    {
        $sub_category = Category::findOrFail($sub_cat_id);
        if($sub_category)
        {
            $sub_category->delete();
            return redirect()->back()->with('flash_message' , _i('Deleted Successfully !'));
        }else{
            return redirect()->back()->with('flash_message' , _i('Not Found !'));
        }
    }
    public function getall($store)
    {
        $categories = Category::where('store_id',$store)->orderBy('number','asc')->with(['children' => function($query){
            $query->orderBy('number','asc');
        }])->get();
        return response()->json($categories);
    }

}
