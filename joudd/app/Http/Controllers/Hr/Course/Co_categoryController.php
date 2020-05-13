<?php

namespace App\Http\Controllers\Hr\Course;

use App\Hr\Course\Co_category;
use App\Hr\Course\Course_co_category;
use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Translation;
use Yajra\DataTables\DataTables;

class Co_categoryController extends Controller
{

  public function allCategory()
  {
      $categories = Co_category::all();
      $languages = Language::all() ;
      $translation = Translation::where('table_name','course categories')->first();
     
    return view('admin.hr.course.courses.allCategory' ,compact('categories' ,'languages','translation'));
  }

  public function getDatatableCourseCategory()
  {
      
    $co_category = Co_category::select(['id','cat_name','parent_id','created_at','updated_at' , 'lang_id']);

    return DataTables::of($co_category ) //.$co_category->id.'/edit
        ->editColumn('parent_id' , function ($co_category){
            if($co_category->parent_id != null){
                $parent = Co_category::where('id' , $co_category->parent_id)->first();
                return $parent->cat_name;
            }
                return "This Is Main";
        })
        ->editColumn('lang_id', function($query) {
            $language = Language::where('id' , $query->lang_id)->first();
            return $language->title ;
        })

        ->addColumn('action', function ($query ) {
            return $this->generateHtmlEdit_Del([$query->id,$query->cat_name ,$query->parent_id ,$query->lang_id,$query->parent_name] ,$query->id);
        })
        ->rawColumns(['parent_name','action'])
        ->make(true);
  }

  public function storeCategory(Request $request)
  {
//      dd($request->sub_cat_name);
    $rules = [
//      'cat_name' => ['required', 'max:150','min:3', 'unique:co_categories'],
      'cat_name' => ['required','max:150','min:2', 'unique:co_categories,cat_name'],
    ];

    $validator = Validator::make($request->all() , $rules);
    if($validator->fails())
      return redirect()->back()->withErrors($validator);

    $category = Co_category::create([
      'cat_name' => $request->cat_name,
      'parent_id' => $request->parent_cat,
      'lang_id' => $request->lang_id,
    ]);
    $category->save();
    return redirect('/admin/course/category/all')->withFlashMessage(_i('Added Successfully !'));
  }

  public function updateCategory($id, Request $request)
  {
    $category = Co_category::find($id);
    $rules = [
        'cat_name' => ['required', 'max:150','min:3', Rule::unique('co_categories')->ignore($category->id)]
    ];

    $validator = Validator::make($request->all() , $rules);
    if($validator->fails())
      return redirect()->back()->withErrors($validator);

    $category->parent_id = $request->parent_cat;
    $category->cat_name = $request->cat_name;
    $category->lang_id = $request->lang_id;
    $category->save();

    return redirect('/admin/course/category/all')->withFlashMessage(_i('Updated Successfully !'));
  }

  protected function deleteCategory(Request $request)
  {
    
      $category = Co_category::find($request->id);
      
      $course_category = Course_co_category::where('co_category_id',$category->id)->get();
      if(count($course_category) > 0) {
          return redirect()->back()->with('danger' , _i('Can`t Delete This Category because related course delete it first !'));
      }
      $sub_categories = Co_category::where('parent_id' , $category->id)->get();
      if(count($sub_categories) > 0)
      {
          return redirect()->back()->with('danger' , _i('Can`t Delete This Category becaust it contain sub category delete it first !'));
      }else{
          $category->delete();
          return redirect('/admin/course/category/all')->withFlashMessage(_i('Deleted Successfully !'));
      }
  }


  public function list(Request $request)
  {
      $categories = Co_category::where('lang_id' , $request->lang_id)->pluck("cat_name","id");
      return $categories ;
  }


}

?>
