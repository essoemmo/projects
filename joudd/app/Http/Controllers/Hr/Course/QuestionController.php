<?php

namespace App\Http\Controllers\Hr\Course;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use App\Hr\Course\Question;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    //
    private $roles = [];
    public function indexCourseQuestions()
    {
        return view('admin.hr.course.Question.course_question');
    }
    public function indexTrainerQuestions()
    {
        return view('admin.hr.course.Question.trainer_question');
    }
    public function getDataCourse()
    {
        return DataTables::of(Question::where('type', '=', 'course'))->editColumn('is_multi',function($question){
            return ($question->is_multi)?'Yes':'No';
        })->editColumn('is_required',function($question){
            return ($question->is_required)?'Yes':'No';
        })->addColumn('action', function ($question) {
            return $this->generateHtmlEdit_Delete([$question->id, $question->title, $question->is_multi,$question->is_required], $question->id);
        })->make(true);
    }
    public function getDataTrainer()
    {
        return DataTables::of(Question::where('type', '=', 'trainer'))->editColumn('is_multi',function($question){
            return ($question->is_multi)?'Yes':'No';
        })->editColumn('is_required',function($question){
            return ($question->is_required)?'Yes':'No';
        })->addColumn('action', function ($question) {
            return $this->generateHtmlEdit_Delete([$question->id, $question->title, $question->is_multi,$question->is_required], $question->id);
        })->make(true);
    }
    public function store(Request $request)
    {
        session()->forget('error_id');
        $request->session()->put('error_add',1);
        $request->validate($this->roles);
        $question = new Question();
        $question->title = $request->input('title');
        ($request->input('is_multi') == 'on') ? $question->is_multi = 1 : $question->is_multi = 0;
        ($request->input('is_required') == 'on') ? $question->is_required = 1 : $question->is_required = 0;
        $question->type = $request->input('type');
        $question->save();
        return redirect()->back()->withFlashMessage(_i('Added Successfully !'));
    }
    public function update(Request $request)
    {
        session()->forget('error_add');
        $request->session()->put('error_id',$request->input('id'));
        $request->validate($this->roles);
        $question = Question::findOrFail($request->input('id'));
        $question->title = $request->input('title');
        ($request->input('is_multi') == 'on') ? $question->is_multi = 1 : $question->is_multi = 0;
        ($request->input('is_required') == 'on') ? $question->is_required = 1 : $question->is_required = 0;
        $question->type = $request->input('type');
        $question->save();
        return redirect()->back()->withFlashMessage(_i('Updated Successfully !'));
    }
    public function destroy(Request $request)
    {
        Question::destroy($request->input('id'));
        return redirect()->back()->withFlashMessage(_i('Deleted Successfully !'));
    }
}
