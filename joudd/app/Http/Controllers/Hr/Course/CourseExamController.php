<?php

namespace App\Http\Controllers\Hr\Course;

use App\Hr\Course\Course;
use App\Hr\Course\Exam;
use App\Hr\Course\Exam_data;
use App\Hr\Course\Exam_Question;
use App\Hr\Course\Question_choice;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CourseExamController extends Controller {

    public function index() {
        return view('admin.hr.course.courses.course_exam.all');
    }

    public function getDatatableExams() {
        $exam = Exam::leftJoin('exam_data', 'exam_data.exam_id', 'exams.id')
                ->leftJoin('courses', 'courses.id', 'exams.id')
                ->select('exams.*', 'courses.title', 'exam_data.title', 'exam_data.lang_id')
                ->get();

        //        dd($exam);

        return DataTables::of($exam)
                        ->addColumn('action', function ($exam) {
                            return '<a href="../course/course_exam/' . $exam->id . '/edit" class="btn btn-icon waves-effect waves-light btn btn-primary" title="' . _i("Edit") . '"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                                    '<a href="../course/course_exam/' . $exam->id . '/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="' . _i("Delete") . '"><i class="fa fa-remove"></i> </a>' . "&nbsp;";
                        })
                        ->editColumn('type', function($exam) {
                            return $exam->type;
                            //
                        })
                        ->editColumn('lang_id', function($exam ) {
                            $lang = Language::findOrfail($exam->lang_id);
                            return $lang->code == 'ar' ? _i('Arabic') : _i('English');
                            //
                        })
                        ->make(true);
    }

    public function create($id) {
        $course = Course::findOrFail($id);
        return view('admin.hr.course.courses.course_exam.create', compact('course'))->render();
    }

    protected function getChoices($id , Request $request) {
        $result = Question_choice::where("question_id", $id)->get();
        return response()->json([
            "status" => 1, 
            "msg", _i("ok"), 
            "data" => $result]);
    }

    protected function addChoice(Request $request) {

        $find = Question_choice::where("title", $request->title)->where("question_id", $request->input("question_id"))->first();
        if ($find == null)
            $result = Question_choice::create($request->all());
        else
            return response()->json(["status" => 0, "msg", _i("added before")]);
        //return response()->json($result);
        return response()->json(["status" => 1, "msg", _i("Saved Successfuly")]);
    }
    protected function delChoices(Request $request) {

        
        $chks =($request->input("chk_del"));
        if(isset($chks) && count($chks)>0)
        {
        $ids = implode(",", $chks);
        
      $removed =   Question_choice::destroy($chks);
             return response()->json(["status" => 1, "msg" => $removed." "._i("deletd")]);

        }
        
    
        //return response()->json($result);
        return response()->json(["status" => 1, "msg" => _i("No items deleted")]);
    }

    public function store($id, Request $request) {
        $course = Course::findOrFail($id);
        $rules = [
            'duration' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);


        $exam = Exam::create([
                    'type' => 'course',
                    'type_id' => $course->id,
                    'duration' => $request->duration,
                    'start' => $request->start,
                    'end' => $request->end,
                    'is_active' => $request->published,
                    'created' => Carbon::now(),
        ]);

        //        dd($request->all());

        $exam_data = [
            'ar' => [
                'title' => $request->ar_title,
                'description' => $request->ar_description,
                'lang_id' => Language::where('code', 'ar')->first()->id,
                'exam_id' => $exam->id,
            ],
            'en' => [
                'title' => $request->en_title,
                'description' => $request->en_description,
                'lang_id' => Language::where('code', 'en')->first()->id,
                'exam_id' => $exam->id,
            ],
        ];

        DB::table('exam_data')->insert($exam_data);

//        return redirect('/admin/course/course_exam/'.$exam->id.'/edit')->withFlashMessage(_i('Added Successfully !'));
        return redirect()->back()->with('flash_message', _i('Added Successfully !'));
    }

    public function edit($id) {
        $exam = Exam::findOrFail($id);
        //        dd($exam);
        $course = Course::where('id', $exam->type_id)->first();
        $exam_data_en = Exam_data::where('exam_id', $exam->id)->where('lang_id', Language::where('code', 'en')->first()->id)->first();
        $exam_data_ar = Exam_data::where('exam_id', $exam->id)->where('lang_id', Language::where('code', 'ar')->first()->id)->first();
        $question_check = Exam_Question::where('exam_id', $exam->id)->get();
        $exam_questions = Exam_Question::join('exam_questions as en', 'exam_questions.id', 'en.source_id')
                        ->where('exam_questions.exam_id', $exam->id)
                        ->select('exam_questions.title as ar_title', 'exam_questions.score as score', 'en.title as en_title', 'exam_questions.id as id')->get();
        if (count($exam_questions) > 0) {
            foreach ($exam_questions as $question) {
                $question_choice = Question_choice::where('question_id', $question->id)->first();
                return view('admin.hr.course.courses.course_exam.edit', compact('exam', 'course', 'exam_data_en', 'exam_data_ar', 'exam_questions', 'question_check', 'question_choice'));
            }
        } else {
            return view('admin.hr.course.courses.course_exam.edit', compact('exam', 'course', 'exam_data_en', 'exam_data_ar', 'exam_questions', 'question_check'));
        }
    }

    public function update($id, Request $request) {
        $exam = Exam::findOrFail($id);
        $exam->duration = $request->duration;
        $exam->start = $request->start;
        $exam->end = $request->end;
        $exam->is_active = $request->published;
        $exam->save();

        if ($exam->id != null) {
            $exam_data = Exam_data::where('exam_id', $exam->id)->delete();
            $exam_data = [
                'ar' => [
                    'title' => $request->ar_title,
                    'description' => $request->ar_description,
                    'lang_id' => Language::where('code', 'ar')->first()->id,
                    'exam_id' => $exam->id,
                ],
                'en' => [
                    'title' => $request->en_title,
                    'description' => $request->en_description,
                    'lang_id' => Language::where('code', 'en')->first()->id,
                    'exam_id' => $exam->id,
                ],
            ];
            DB::table('exam_data')->insert($exam_data);
        }
        //    dd($request->all());
        $exam_question = Exam_Question::where('exam_id', $exam->id)->delete();
        if ($request->question_en != null && $request->question_ar != null && $request->score != null) {
            for ($ii = 0; $ii < count($request->question_en); $ii++) {
                $question_en = $request->question_en[$ii];
                $question_ar = $request->question_ar[$ii];
                $score = $request->score[$ii];
                $exam_question_ar = Exam_Question::create([
                            'title' => $question_ar,
                            'score' => $score,
                            'exam_id' => $exam->id,
                            'lang_id' => Language::where('code', 'ar')->first()->id,
                            'source_id' => null,
                ]);

                $exam_question_en = Exam_Question::create([
                            'title' => $question_en,
                            'score' => $score,
                            'exam_id' => $exam->id,
                            'lang_id' => Language::where('code', 'en')->first()->id,
                            'source_id' => $exam_question_ar->id,
                ]);
            }
        }

        return redirect()->back()->with('flash_message', _i('Updated Successfully !'));
    }

    public function choice_change(Request $request) {

        $check = Question_choice::where('question_id', $request->question_id)->where('is_answer', $request->choice)->where('is_answer', '!=', null)->exists();
        if ($check == true) {
            return response()->json($check);
        } elseif ($check == false) {
            $choice_check = Question_choice::where('question_id', $request->question_id)->where('is_answer', '!=', $request->choice)->where('is_answer', '!=', null)->exists();
            if ($choice_check == false) {
                $choice = Question_choice::create([
                            'title' => $request->title,
                            'question_id' => $request->question_id,
                            'lang_id' => Language::where('code', 'ar')->first()->id,
                            'is_answer' => $request->choice,
                ]);
            } else {
                $id = Question_choice::where('question_id', $request->question_id)->where('is_answer', '!=', $request->choice)->where('is_answer', '!=', null)->first()->id;
                $choice = Question_choice::findOrFail($id);
                $choice->title = $request->title;
                $choice->is_answer = $request->choice;
                $choice->update();
                return response()->json($check);
            }
        } else {
            $choice = Question_choice::create([
                        'title' => $request->title,
                        'question_id' => $request->question_id,
                        'lang_id' => Language::where('code', 'ar')->first()->id,
                        'is_answer' => $request->choice,
            ]);
        }
    }

    public function delete($id) {
        $exam = Exam::findOrFail($id);
        Exam::destroy($id);
        return redirect()->back()->with('flash_message', _i('Video has been deleted successfully!'));
    }

}
