<?php


namespace App\Http\Controllers\Hr\Course;


use App\Hr\Course\Course;
use App\Hr\Course\Exam;
use App\Hr\Course\Exam_data;
use App\Hr\Course\Exam_Question;
use App\Hr\Course\Question_choice;
use App\Hr\Course\Trainer;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class TrainerController extends Controller
{

    // show all trainers
    public function allTrainers()
    {
        return view('admin.hr.course.trainers.allTrainers');
    }

    public function pendingTrainers()
    {
        return view('admin.hr.course.trainers.pendingTrainers');
    }

    // show report for all trainers
    public function trainerReports()
    {
        return view('admin.hr.course.trainers.reports');
    }

    public function pendingTrainersDatatable(Request $request) {
        $trainer = DB::table('vw_trainers')->where('type', 'trainer')->where('is_active', 0)->select(['id', 'first_name', 'last_name', 'is_active', 'created_at', 'updated_at']);

        if (request()->has('gender')) {
            $trainer->where('gender', '=', $request->gender);
        }
        if (request()->has('date')) {
            $trainer->where('created_at', '=', $request->date);
        }

        if (auth()->user()->can('course-activation')) {
            return DataTables::of($trainer)
                ->editColumn('is_active', function ($trainer) {
                    if ($trainer->is_active == 1) {
                        return _i('Active');
                    } else {
                        return _i('Not Active');
                    }
                })
                ->editColumn('created_at', function ($trainer) {
                    return date("Y M d ", strtotime($trainer->created_at));
                })
                ->addColumn('action', function ($trainer) {
                    return '<a href="' . $trainer->id . '/edit" class="btn btn-icon waves-effect waves-light btn-default" title="' . _i("Edit") . '"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                        '<a href="' . $trainer->id . '/delete" class="btn btn-icon waves-effect waves-light btn-pink" title="' . _i("Delete") . '"><i class="fa fa-remove"></i> </a>' . "&nbsp;" .
                        '<a href="javascript:void(0)"  class="change_status waves-effect" title="' . _i("Activate") . '">
                        <i class="fa fa-check"></i>
                        <input type="hidden" name="trainer_id" id="trainer_id" value="' . $trainer->id . '">
                    </a>';
                })
                ->make(true);
        } else {
            return DataTables::of($trainer)
                ->editColumn('is_active', function ($trainer) {
                    if ($trainer->is_active == 1) {
                        return _i('Active');
                    } else {
                        return _i('Not Active');
                    }
                })
                ->editColumn('created_at', function ($trainer) {
                    return date("Y M d ", strtotime($trainer->created_at));
                })
                ->addColumn('action', function ($trainer) {
                    return '<a href="' . $trainer->id . '/edit" class="btn btn-icon waves-effect waves-light btn-default" title="' . _i("Edit") . '"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                        '<a href="' . $trainer->id . '/delete" class="btn btn-icon waves-effect waves-light btn-pink" title="' . _i("Delete") . '"><i class="fa fa-remove"></i> </a>' . "&nbsp;" ;
                })
                ->make(true);
        }
    }

    public function changeStatus($id) {
        $pending = User::findOrFail($id);
        if($pending->is_active == 0) {
            $pending->is_active = 1;
            $pending->update();
        } elseif($pending->is_active == 1) {
            $pending->is_active = 0;
            $pending->update();
        }
    }


    // make datatable for all trainers
    public function  getDatatableTrainers(Request $request)
    {
        $trainer = Trainer::leftJoin('users','users.id','trainers.user_id')->where('users.is_active', 1)->select(['trainers.id', 'trainers.user_id', 'first_name', 'last_name', 'trainers.skills', 'is_active', 'trainers.created_at', 'trainers.updated_at', 'trainers.gender']);

        if (request()->has('gender')) {
            $trainer->where('gender', '=', $request->gender);
        }
        if (request()->has('date')) {
            $trainer->where('created_at', '=', $request->date);
        }
        return DataTables::of($trainer)
            ->editColumn('is_active', function ($trainer) {
                if ($trainer->is_active == 1) {
                    return _i('Active');
                } else {
                    return _i('Not Active');
                }
            })
            ->editColumn('gender' , function($trainer){
                if ($trainer->gender == 'Female') {
                    return _i('Female');
                } else {
                    return _i('Male');
                }

            })
            ->editColumn('created_at', function ($trainer) {
                return date("Y M d ", strtotime($trainer->created_at));
            })
            ->addColumn('action', function ($trainer) {
                return '<a href="' . $trainer->user_id . '/edit" class="btn btn-icon waves-effect waves-light btn-default" title="' . _i("Edit") . '"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                    '<a href="' . $trainer->user_id . '/delete" class="btn btn-icon waves-effect waves-light btn-pink" title="' . _i("Delete") . '"><i class="fa fa-remove"></i> </a>';
            })
            ->make(true);
    }

    public function addTrainer()
    {
        return view('admin.hr.course.trainers.addTrainer');
    }


    public function store(Request $request)
    {
        $rules = [
            'first_name' => array('required', 'max:150'),
            'last_name' => array('required', 'max:150'),
            'mobile' => array('required', 'max:15', 'unique:users'),
            //  'skills' => array('required', 'min:3'),
            'is_active' => array('required'),
        ];
//dd($request);
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $user = new \App\User();
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt("123456");
            $user->is_admin = 0;
            $user->is_active = $request->is_active;
            $user->type = "trainer";
            $user->mobile = $request->mobile;
            $user->save();

            $traineer = Trainer::create([
//                'first_name' => $request->first_name,
//                'last_name' => $request->last_name,
                // 'mobile' => $request->mobile,
                'gender' => $request->gender,
                'skills' => $request->skills,
//                'is_active' => $request->is_active,
                'created_at' => $request->created_at
            ]);
            $traineer->user_id = $user->id;
            $traineer->save();
        }


        return redirect('/admin/trainer/' . $traineer->id . '/edit')->withFlashMessage(_i('Added Successfully !'));

    }


    public function editTrainer($id)
    {
        $trainer = User::leftJoin('trainers', 'trainers.user_id','users.id')
            ->where('users.id', $id)
            ->select('users.*','trainers.skills','trainers.gender')
            ->first();
        return view('admin.hr.course.trainers.editTrainer', compact('trainer'));
    }


    public function updateTrainer($id, Request $request)
    {
        $user = User::find($id);
        $trainer = Trainer::where('user_id', $user->id)->first();
        $rules = [
            'first_name' => array('required', 'max:150'),
            'last_name' => array('required', 'max:150'),
            'mobile' => array('required', 'max:15', Rule::unique('users')->ignore($user->id)),
            // 'skills' => array('required', 'max:250'),
            'is_active' => array('required'),
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->is_active = $request->is_active;
            $user->mobile = $request->mobile;
            $user->update();


            $trainer->gender = $request->gender;
            $trainer->skills = $request->skills;
            $trainer->created_at = $request->created_at;
            $trainer->update();
        }
        return redirect('/admin/trainer/' . $user->id . '/edit')->withFlashMessage(_i('Updated Successfully !'));

    }


    public function deleteTrainer($id)
    {
        $user = User::find($id);
        $trainer = Trainer::where('user_id', $user->id)->first();
        $user->delete();
        $trainer->delete();
        return redirect('/admin/trainer/all')->withFlashMessage(_i('Deleted Successfully !'));
    }

    public function exportTrainer()
    {
//        dd(request()->all());
        $trainers = DB::table('trainers')
            ->select(['id', 'first_name', 'last_name', 'skills', 'is_active', 'gender', 'created_at']);

        if (request()->input("txt_gender") !== null) {
            $db = $trainers->where("gender", request()->input("txt_gender"));
        }
        if (request()->input("txt_date") !== null) {
            $db = $trainers->where("created_at", '=' ,request()->input("txt_date"));
        }

        $data = $trainers->get();
        foreach ($data as $row)
        {
            $row->gender = ( $row->gender == 'Female') ? _i('Female') : _i('Male');
            $row->is_active = ( $row->is_active == 1) ? _i('Active') : _i('Not Active');
            $row->created_at = (date('Y-m-d', strtotime($row->created_at)));
        }
        return Excel::download(new ExportTrainer($data), 'trainer_report.xlsx');
    }

    public function teacherExams()
    {
        //dd(auth()->user()->id);
        return view('front.courses.teacher.exam.teacher_exams');
    }

    public function getDatatableTeacherExams() {
        $exam = Exam::leftJoin('exam_data','exam_data.exam_id','exams.id')
            ->where('exam_data.lang_id' , getLang(session('lang')))
            ->Join('courses','courses.id','exams.id')
//            ->where('courses.user_id', auth()->user()->id)
            ->select('exams.*','courses.title','exam_data.title','exam_data.lang_id')
            ->get();

        return DataTables::of($exam)
            ->addColumn('action', function ($exam) {
                return '<a href="../course/course_exam/' . $exam->id . '/edit" class="btn btn-icon waves-effect waves-light btn btn-info" title="'._i("Edit").'"><i class="fa fa-edit"></i> </a>' . "&nbsp;" .
                    '<a href="../course/course_exam/' . $exam->id . '/delete" class="btn btn-icon waves-effect waves-light btn btn-danger" title="'._i("Delete").'"><i class="fa fa-remove"></i> </a>' . "&nbsp;" ;
            })
            ->editColumn('type_id', function($exam ) {
                $course = Course::findOrfail($exam->type_id);
                return $course->title;
            })

            ->editColumn('lang_id', function($exam ) {
                $lang = Language::findOrfail($exam->lang_id);
                return $lang->title ;
            })
            ->make(true);
    }


    public function teacherCreateExam($id)
    {
        $course = Course::findOrFail($id);
        return view('front.courses.teacher.exam.add_exam' , compact('course'));
    }

    public function teacherEditCourseExam($id)
    {
        $exam = Exam::findOrFail($id);
        //        dd($exam);
        $course = Course::where('id' , $exam->type_id)->first();
        $exam_data_en = Exam_data::where('exam_id', $exam->id)->where('lang_id', Language::where('code','en')->first()->id)->first();
        $exam_data_ar = Exam_data::where('exam_id', $exam->id)->where('lang_id', Language::where('code','ar')->first()->id)->first();
        $question_check = Exam_Question::where('exam_id', $exam->id)->get();
        $exam_questions = Exam_Question::join('exam_questions as en','exam_questions.id','en.source_id')
            ->where('exam_questions.exam_id', $exam->id)
            ->select('exam_questions.title as ar_title','exam_questions.score as score','en.title as en_title','exam_questions.id as id')->get();
        if(count($exam_questions) > 0) {
            foreach ($exam_questions as $question) {
                $question_choice = Question_choice::where('question_id', $question->id)->first();
                return view('front.courses.teacher.exam.edit_exam' ,compact('exam','course','exam_data_en','exam_data_ar','exam_questions','question_check','question_choice'));
            }
        } else {
            return view('front.courses.teacher.exam.edit_exam' ,compact('exam','course','exam_data_en','exam_data_ar','exam_questions','question_check'));
        }
    }

    public function teacherUpdateCourseExam()
    {

    }

}
