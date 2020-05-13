<?php

namespace App\Http\Controllers\Front;

use App\Hr\Course\Exam;
use App\Hr\Course\Exam_Question;
use App\Hr\Course\Question_choice;
use App\Hr\Course\User_Exam;
use App\Hr\Course\User_Exam_Answer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ExamController extends Controller
{
    public function index() {
        dd('no');
        if(auth()->check()) {
            $exams = Exam::leftJoin('exam_data','exam_data.exam_id','exams.id')
                ->leftJoin('courses','courses.id','exams.type_id')
                ->where('exam_data.lang_id', getLang(session('lang')))
                ->where('exams.is_active', 1)
                ->where('exams.end', '>=' , Carbon::today())
                ->paginate(6);
//            dd($exams);
            return view('front.quizzes.quizzes', compact('exams'));
        } else {
            return redirect('user/login');
        }
    }

    public function quiz_join($id) {
        if(auth()->check()) {
            $exam = Exam::findOrFail($id);
            $user_exam = User_Exam::create([
                'user_id' => auth()->id(),
                'exam_id' => $exam->id,
                'created' => Carbon::now(),
            ]);
            return redirect()->route('single_quiz',['id' => $id]);
        } else {
            return redirect('user/login');
        }
    }

    public function single_quiz($id) {
        if(auth()->check()) {
            $user_exam = User_Exam::where('user_id',auth()->id())->first();
            if($user_exam != null) {
                $exam = Exam::findOrFail($user_exam->exam_id);
                $questions_exams = Exam_Question::where('exam_id', $exam->id)->where('source_id',null)->pluck('id')->toArray();
                $user_exam_answer = User_Exam_Answer::where('user_exam_id',$user_exam->id)->pluck('question_id')->toArray();
                foreach($questions_exams as $questions_exam) {
//            in_array($questions_exam,$user_exam_answer);
//            dd($user_exam_answer);
                    if(in_array($questions_exam,$user_exam_answer)) {
                        return redirect()->route('quiz_result',['id',$exam->id]);
                    }
                }
                $exam = Exam::leftJoin('exam_data','exam_data.exam_id','exams.id')
                    ->leftJoin('courses','courses.id','exams.type_id')
                    ->where('exams.id', $id)
                    ->where('exam_data.lang_id', getLang(session('lang')))
                    ->where('exams.is_active', 1)
                    ->where('exams.end', '>=' , Carbon::today())
                    ->first();
                $user_exam = User_Exam::where('user_id',auth()->id())->where('exam_id',$id)->exists();

                if($user_exam == true) {
                    $quizzes = Exam_Question::where('exam_id',$id)->where('source_id', null)->get();
//            dd($exam,$quizzes);

                    return view('front.quizzes.single_quiz',compact('exam','quizzes'));
                } else {
                    return redirect()->route('quiz_join',['id' => $id]);
                }
            } else {
                return redirect()->route('quiz_join',['id' => $id]);
            }

        } else {
            return redirect('user/login');
        }
    }

    public function quiz_check(Request $request) {
//        dd($request->customRadioInline);

        $user_exam = User_Exam::where('user_id',auth()->id())->first();
        $exam = Exam::findOrFail($user_exam->exam_id);
        $questions_exams = Exam_Question::where('exam_id', $exam->id)->where('source_id',null)->pluck('id')->toArray();
        $user_exam_answer = User_Exam_Answer::where('user_exam_id',$user_exam->id)->pluck('question_id')->toArray();
        foreach($questions_exams as $questions_exam) {
//            in_array($questions_exam,$user_exam_answer);
//            dd($user_exam_answer);
            if(in_array($questions_exam,$user_exam_answer)) {
                return redirect()->route('quiz_result',['id',$exam->id]);
            }
        }
        foreach ($request->customRadioInline as $key => $value) {
            $question = Exam_Question::findOrFail($key);
            $user_exam = User_Exam::where('user_id', auth()->id())->where('exam_id', $question->exam_id)->first();
            $question_choice = Question_choice::where('question_id', $key)->first();
            if($value == $question_choice->is_answer) {
                $user_answer = User_Exam_Answer::create([
                    'user_exam_id' => $user_exam->id,
                    'question_id' => $question_choice->question_id,
                    'answer_id' => $question_choice->id,
                    'score' => $question->score,
                    'created' => Carbon::now(),
                    'is_answer' => $value,
                ]);
            } else {
                $user_answer = User_Exam_Answer::create([
                    'user_exam_id' => $user_exam->id,
                    'question_id' => $question_choice->question_id,
                    'answer_id' => $question_choice->id,
                    'score' => 0,
                    'created' => Carbon::now(),
                    'is_answer' => $value,
                ]);
            }
        }
        return redirect()->route('quiz_result',['id',$exam->id]);
    }

    public function quiz_result($id) {
        $user_exam = User_Exam::where('user_id',auth()->id())->first();
        $user_answer_score = User_Exam_Answer::where('user_exam_id', $user_exam->id)->sum('score');
        $user_answer_wrong = User_Exam_Answer::where('user_exam_id', $user_exam->id)->where('score', 0)->count();
        $user_answer_correct = User_Exam_Answer::where('user_exam_id', $user_exam->id)->where('score', '!=', 0)->count();
        $user_exam_check = User_Exam::where('user_id',auth()->id())->where('exam_id',$user_exam->exam_id)->exists();
        if($user_exam_check == true) {
            $quizzes = Exam_Question::where('exam_id', $user_exam->exam_id)->where('source_id', null)->get();
        }
//        dd($user_exam,$user_answer_wrong,$user_answer_correct,$user_answer_score,$quizzes);
        return view('front.quizzes.result',compact('user_answer_score','user_answer_correct','user_answer_wrong','quizzes'));
    }
}
