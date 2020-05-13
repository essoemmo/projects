<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\CategoryDataTable;
use App\Models\Category;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:show-categories'])->only('index');
        $this->middleware(['permission:category-add'])->only('store');
        $this->middleware(['permission:category-edit'])->only('update');
        $this->middleware(['permission:category-delete'])->only('destroy');
    }


    public function index(CategoryDataTable $category)
    {
        return $category->render('admin.category.index' , ['title' => _i('Categories')]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'title' => 'required',
        ],[
            'title.required'=>_i('title required'),
        ]);

        $addMember = new Category();
        $addMember->name = $request->title;
        $addMember->lang_id = $request->language;

        $addMember->save();

        session()->flash('success',_i('Add Succfully'));
        return redirect()->route('categories.index');
    }



    public function update(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'title' => 'required',
        ],[
            'title.required'=>_i('title required'),
        ]);

        $addMember =Category::findOrFail($request->id);
        $addMember->name = $request->title;
        $addMember->lang_id = $request->language;

        $addMember->save();

        session()->flash('success',_i('Add Succfully'));
        return redirect()->route('categories.index');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success',_i('deleted Succfully'));
        return redirect()->route('categories.index');
    }
}
