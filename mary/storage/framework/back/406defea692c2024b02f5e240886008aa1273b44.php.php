<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StoriesDataTabelsDataTable;
use App\Models\Story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:stories-add'])->only('store');
        $this->middleware(['permission:stories-edit'])->only('update');
        $this->middleware(['permission:stories-delete'])->only('delete');
    }

    public function index(StoriesDataTabelsDataTable $story)
    {
        return $story->render('admin.stories.index' , ['title' => _i('Stories')]);

    }

    public function create(){
        return view('admin.stories.create',['title' => _i('Stories')]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'language' => 'required',
            'title' => 'required',
            'conteent' => 'required',
        ],[
            'title.required'=>_i('title required'),
            'conteent.required'=>_i('content required'),
        ]);

        $addStory = new Story();
        $addStory->title = $request->title;
        $addStory->user_id = $request->user_id;
        $addStory->lang_id = $request->language;
        $addStory->content = $request->conteent;
        if (isset($request->publish)){
            $addStory->published = 'true';
        }else{
            $addStory->published = 'false';
        }
        $addStory->save();

        session()->flash('success',_i('Add Succfully'));
        return redirect()->route('Stories.index');
    }


    public function update(Request $request, Story $story)
    {

        $request->validate([
            'language' => 'required',
            'title' => 'required',
            'conteent' => 'required',
        ],[
            'title.required'=>_i('title required'),
            'conteent.required'=>_i('content required'),
        ]);

        $addStory =Story::findOrFail($request->id);
        $addStory->title = $request->title;
        $addStory->user_id = $request->user_id;
        $addStory->lang_id = $request->language;
        $addStory->content = $request->conteent;
        if (isset($request->publish)){
            $addStory->published = 'true';
        }else{
            $addStory->published = 'false';
        }
        $addStory->save();

        session()->flash('success',_i('edited Succfully'));
        return redirect()->route('Stories.index');
    }


    public function destroy($id)
    {
        $del = Story::findOrFail($id);
        $del->delete();
        session()->flash('success',_i('deleted Succfully'));
        return redirect()->route('Stories.index');
    }
}
