<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\StoriesDataTabelsDataTable;
use App\Models\Language;
use App\Models\Partenership;
use App\Models\Story;
use App\Models\Story_data;
use App\Models\User_story;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:show-stories'])->only('index');
        $this->middleware(['permission:stories-add'])->only('create');
        $this->middleware(['permission:stories-edit'])->only('update');
        $this->middleware(['permission:stories-delete'])->only('destroy');
    }

    public function index(StoriesDataTabelsDataTable $story)
    {
        return $story->render('admin.stories.index' , ['title' => _i('Stories')]);

    }

    public function create(){
        $langs = Language::get();
        return view('admin.stories.create',['title' => _i('Stories') , 'langs' => $langs]);
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            '*_title' => 'required',
            '*_conteent' => 'required',
        ]);

        $addStory = new Story();
        $addStory->user_id = $request->user_id;
        if (isset($request->publish)){
            $addStory->published = 'true';
        }else{
            $addStory->published = 'false';
        }
        $addStory->save();

        if ($addStory->save()){

            for ($i = 0 ; $i<count($request->lang_id) ; $i++){
                $lang = Language::findOrFail($request->lang_id[$i]);
                Story_data::create([
                   'title' => $request->get($lang->code.'_title'),
                   'content' => $request->get($lang->code.'_conteent'),
                    'stories_id' => $addStory->id,
                    'lang_id' => $request->lang_id[$i],
                ]);
            }

            User_story::create([
               'user_id' => $request->user_id,
               'store_id' => $addStory->id,
               'Partner_id' => $request->parent_id,
                'type' => $request->type,
                ]);

//            Partenership::create([
//                'user_id' => $request->user_id,
//                'partent_id' => $request->parent_id,
//                'type' => $request->type,
//            ]);
        }

        session()->flash('success',_i('Add Succfully'));
        return redirect()->route('Stories.index');
    }


    public function edit($id){
        $title = _i('edit story');
        $langs = Language::get();
        $story =  Story::
        leftJoin('story_datas','stories.id','=','story_datas.stories_id')
            ->leftJoin('user_story','stories.id','=','user_story.store_id')
            ->select(['stories.*',
                'story_datas.title',
                'story_datas.content',
                'story_datas.lang_id',
                'user_story.Partner_id',
                'user_story.type as type',

            ])
            ->where('story_datas.lang_id',getLang())
            ->where('stories.id',$id)
            ->first();

        $storyLang =  Story::
        leftJoin('story_datas','stories.id','=','story_datas.stories_id')
            ->select(['stories.*',
                'story_datas.title',
                'story_datas.content',
                'story_datas.lang_id',
            ])
            ->where('stories.id',$id)
            ->pluck('lang_id')->toArray();

        $stories=  Story::
        leftJoin('story_datas','stories.id','=','story_datas.stories_id')
            ->select(['stories.*',
                'story_datas.title',
                'story_datas.content',
                'story_datas.lang_id',
            ])
            ->where('stories.id',$id)
            ->get();

        return view('admin.stories.edit',compact('story','langs','title','storyLang','stories'));

    }

    public function update(Request $request, Story $story,$id)
    {


        $request->validate([
            '*_title' => 'required',
            '*_conteent' => 'required',
        ],[
            'title.required'=>_i('title required'),
            'conteent.required'=>_i('content required'),
        ]);

        $addStory =Story::findOrFail($id);
        $addStory->user_id = $request->user_id;
        if (isset($request->publish)){
            $addStory->published = 'true';
        }else{
            $addStory->published = 'false';
        }
        $addStory->save();

        if ($addStory->save()){

            for ($i = 0 ; $i<count($request->lang_id) ; $i++){
                $lang = Language::findOrFail($request->lang_id[$i]);
                Story_data:: where('stories_id',$id)->where('lang_id',$request->lang_id[$i])->update([
                    'title' => $request->get($lang->code.'_title'),
                    'content' => $request->get($lang->code.'_conteent'),
                    'stories_id' => $id,
                    'lang_id' => $request->lang_id[$i],
                ]);
            }

            User_story::where('store_id',$id)->update([
                'user_id' => $request->user_id,
                'store_id' => $id,
                'Partner_id' => $request->parent_id,
                'type' => $request->type,
            ]);

//            Partenership::create([
//                'user_id' => $request->user_id,
//                'partent_id' => $request->parent_id,
//                'type' => $request->type,
//            ]);
        }

        session()->flash('success',_i('edited Succfully'));
        return redirect()->back();
    }


    public function destroy($id)
    {
        $del = Story::findOrFail($id);
        $del->delete();
        session()->flash('success',_i('deleted Succfully'));
        return redirect()->route('Stories.index');
    }
}
