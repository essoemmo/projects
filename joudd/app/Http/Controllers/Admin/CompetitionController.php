<?php

namespace App\Http\Controllers\Admin;

use App\Hr\Course\Exam;
use App\Hr\Course\Exam_data;
use App\Hr\Course\Exam_Question;
use App\Hr\Course\Question_choice;
use App\Models\Competition;
use App\Models\Language;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.competition.all');
    }

    public function get_datatable()
    {
        $query = Competition::select(['id','is_active','title', 'created', 'start','end']);
//        dd($query);
        return DataTables::of($query)
            ->addColumn('action', function ($query) {
                return '<a href="../../admin/competition/' . $query->id . '/edit" class="btn btn-icon waves-effect waves-light btn btn-primary" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                    '<a href="../../admin/competition/' . $query->id . '/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>' . "&nbsp;" .
                    '<a href="' . $query->id . '/competition/create" class="btn btn-icon waves-effect waves-light btn btn-info" title="'._i("Add Competition Exam").'"><i class="fa fa-check-square-o"></i> </a>';
            })
            ->editColumn('is_active', function($query ) {
                if ($query->is_active == 1) {
                    return _i('active');
                } else {
                    return _i('not active');
                }
//
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.competition.add');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        if($request->is_active == null) {
            $competition = Competition::create([
                'title' => $request->title,
                'is_active' => 0,
                'start' => $request->start,
                'end' => $request->end,
                'created' => Carbon::now(),
            ]);
        } else {
            $competition = Competition::create([
                'title' => $request->title,
                'is_active' => $request->is_active,
                'start' => $request->start,
                'end' => $request->end,
                'created' => Carbon::now(),
            ]);
        }

        $competition->save();

        return redirect('/admin/competition/all')->withFlashMessage(_i('Added Successfully !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $competition = Competition::findOrFail($id);
        return view('admin.competition.edit',compact('competition'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $competition = Competition::findOrFail($id);
//        dd($bill,$request->all());
        $rules = [
            'exam_id' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
        ];

        $validator = Validator::make($request->all() , $rules);
        if($validator->fails())
            return redirect()->back()->withErrors($validator);

        if($request->is_active == null){
            $competition->exam_id = $request->exam_id;
            $competition->is_active = 0;
            $competition->start = $request->start;
            $competition->end = $request->end;
        } else {
            $competition->exam_id = $request->exam_id;
            $competition->is_active = $request->is_active;
            $competition->start = $request->start;
            $competition->end = $request->end;
        }
        $competition->update();
        return redirect('/admin/competition/all')->withFlashMessage(_i('edited Successfully !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $competition = Competition::findOrFail($id);
        $competition->delete();
        return redirect('/admin/competition/all')->with('flash_message' ,_i('Deleted Successfully !'));
    }

    public function create_exam($id) {
        $course = Competition::findOrFail($id);
        return view('admin.competition.create_exam' , compact('course'))->render();
    }

    public function store_exam($id,  Request $request)
    {
        $competition = Competition::findOrFail($id);
        $rules =  [
            'duration' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
        ];


        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            return redirect()->back()->withErrors($validator);


        $exam = Exam::create([
            'type' => 'competition',
            'type_id' => $competition->id,
            'duration' => $request->duration,
            'start' => $request->start,
            'end' => $request->end,
            'is_active' => $request->published,
            'created' => Carbon::now(),
        ]);

        $exam_data = [
            'ar' => [
                'title' => $request->ar_title,
                'description' => $request->ar_description,
                'lang_id' => Language::where('code','ar')->first()->id,
                'exam_id' => $exam->id,
            ],
            'en' => [
                'title' => $request->en_title,
                'description' => $request->en_description,
                'lang_id' => Language::where('code','en')->first()->id,
                'exam_id' => $exam->id,
            ],
        ];

        DB::table('exam_data')->insert($exam_data);

        return redirect('/admin/competition/competition/'.$exam->id.'/edit')->withFlashMessage(_i('Added Successfully !'));
    }

    public function edit_exam($id)
    {
        $exam = Exam::findOrFail($id);
        $course = Competition::where('id' , $exam->type_id)->first();
        $exam_data_en = Exam_data::where('exam_id', $exam->id)->where('lang_id', Language::where('code','en')->first()->id)->first();
        $exam_data_ar = Exam_data::where('exam_id', $exam->id)->where('lang_id', Language::where('code','ar')->first()->id)->first();
        $question_check = Exam_Question::where('exam_id', $exam->id)->get();
        $exam_questions = Exam_Question::join('exam_questions as en','exam_questions.id','en.source_id')
            ->where('exam_questions.exam_id', $exam->id)
            ->select('exam_questions.title as ar_title','exam_questions.score as score','en.title as en_title','exam_questions.id as id')->get();
        if(count($exam_questions) > 0) {
            foreach ($exam_questions as $question) {
                $question_choice = Question_choice::where('question_id', $question->id)->first();
                return view('admin.hr.course.courses.course_exam.edit' ,compact('exam','course','exam_data_en','exam_data_ar','exam_questions','question_check','question_choice'));
            }
        } else {
            return view('admin.competition.edit_exam' ,compact('exam','course','exam_data_en','exam_data_ar','exam_questions','question_check'));
        }
    }

    public function update_exam($id,Request $request) {
        $exam = Exam::findOrFail($id);
        $exam->duration = $request->duration;
        $exam->start = $request->start;
        $exam->end = $request->end;
        $exam->is_active = $request->published;
        $exam->save();

        if($exam->id != null) {
            $exam_data = Exam_data::where('exam_id', $exam->id)->delete();
            $exam_data = [
                'ar' => [
                    'title' => $request->ar_title,
                    'description' => $request->ar_description,
                    'lang_id' => Language::where('code','ar')->first()->id,
                    'exam_id' => $exam->id,
                ],
                'en' => [
                    'title' => $request->en_title,
                    'description' => $request->en_description,
                    'lang_id' => Language::where('code','en')->first()->id,
                    'exam_id' => $exam->id,
                ],
            ];
            DB::table('exam_data')->insert($exam_data);
        }
        //    dd($request->all());
        $exam_question = Exam_Question::where('exam_id', $exam->id)->delete();
        if($request->question_en != null && $request->question_ar != null && $request->score != null){
            for($ii = 0; $ii < count($request->question_en) ; $ii++) {
                $question_en = $request->question_en[$ii];
                $question_ar = $request->question_ar[$ii];
                $score = $request->score[$ii];
                $exam_question_ar = Exam_Question::create([
                    'title' => $question_ar,
                    'score' => $score,
                    'exam_id' => $exam->id,
                    'lang_id' => Language::where('code','ar')->first()->id,
                    'source_id' => null,
                ]);

                $exam_question_en = Exam_Question::create([
                    'title' => $question_en,
                    'score' => $score,
                    'exam_id' => $exam->id,
                    'lang_id' => Language::where('code','en')->first()->id,
                    'source_id' => $exam_question_ar->id,
                ]);
            }
        }

        return redirect()->back()->with('flash_message' ,_i('Updated Successfully !'));
    }

    public function choice_change_exam(Request $request) {

        $check = Question_choice::where('question_id',$request->question_id)->where('is_answer', $request->choice)->where('is_answer', '!=', null)->exists();
        if($check == true) {
            return response()->json($check);
        } elseif($check == false) {
            $choice_check = Question_choice::where('question_id', $request->question_id)->where('is_answer','!=', $request->choice)->where('is_answer', '!=', null)->exists();
            if($choice_check == false) {
                $choice = Question_choice::create([
                    'title' => $request->title,
                    'question_id' => $request->question_id,
                    'lang_id' => Language::where('code','ar')->first()->id,
                    'is_answer' => $request->choice,
                ]);
            } else {
                $id = Question_choice::where('question_id', $request->question_id)->where('is_answer','!=', $request->choice)->where('is_answer', '!=', null)->first()->id;
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
                'lang_id' => Language::where('code','ar')->first()->id,
                'is_answer' => $request->choice,
            ]);
        }
    }
}
