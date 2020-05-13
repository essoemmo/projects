<?php

namespace App\Http\Controllers\API;

use App\Front\Category;
use App\Hr\Course\Applicant;
use App\Hr\Course\ApplicantCourse;
use App\Hr\Course\Co_category;
use App\Hr\Course\Course_co_category;
use App\Hr\Course\Trainer;
use App\Notifications\acceptTrainer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Array_;
use Validator;
use App\Hr\Course\Course;
use App\Hr\Course\Exam;
use App\Hr\Course\Exam_Question;
use App\Hr\Course\Question_choice;
use App\Hr\Course\User_Exam;
use App\Hr\Course\User_Exam_Answer;

use App\Models\OrderCourses;
use App\Models\Orders;
use App\Models\transactions;
use App\Models\transaction_types;
use App\Models\Currency;
use App\Models\CurrencyConvertor;



class JoudController extends Controller
{


    const lang = 1;
    const country = 1;
    const currencies = 2;

    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    private function showLang() {
        return  self::lang;
    }

    private function showCountry() {
        return  self::country;
    }
    private function showCurrency() {
        return  self::currencies;
    }

    private function getlang($request){

        if (isset($request) && !empty($request)){

            $lang = DB::table('languages')->where('code',$request)->first();
            return $lang->id;
        }else{
            return $this->showLang();
        }
    }
    private function getcountry($request){
        if (isset($request) && !empty($request)){

            $country = DB::table('countries')->where('code',$request)->first();
            return $country->id;
        }else{
            return $this->showCountry();
        }
    }
    private function currency($request){
        if (isset($request) && !empty($request)){

            $currency = DB::table('currencies')->where('code',$request)->first();
            return $currency->id;
        }else{
            return $this->showCurrency();
        }
    }

    private function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
        ];


        return response()->json($response, 200);
    }

    private function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];


        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }


        return response()->json($response, $code);
    }

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),'Login invalid');
//            return response()->json(["status" => "failed", "error" => $validator->errors(),'message' => 'Login invalid'], 401);
        }

        $user = User::where('email',$request->email)->first();
        if (isset($user)){
            if ($user->is_active == 1){
                if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
                    $user = Auth::user();
                    $user['token'] = $user->createToken('MyApp')->accessToken;
                    $user['image'] = str_replace(' ','%20',$user->image);

                    return $this->sendResponse($user,'Welcome to login this application');
//                    return response()->json(["status" => "ok", "data" => $user,'message'=>'Welcome to login this application'], 200);
                } else {
                    return $this->sendError('Login not Unauthorised');
//                    return response()->json(["status" => "failed",'message' => 'Login not Unauthorised'], 401);
                }
            }else{
                return $this->sendError('You should active account');
//                return response()->json(["status" => "failed",'message' => 'You should active account'], 401);
            }
        }else{
            return $this->sendError('This email not record please register now');
//            return response()->json(["status" => "failed",'message' => 'This email not record please register now'], 404);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    private function initUser($request)
    {
        $user = new User();
        $user->first_name = $request->firstName;
        $user->last_name = $request->LastName;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->is_admin = 0;
        $user->mobile = $request->mobile;
        $user->country_id = $request->input('country_id');
        return $user;
    }
    private function upload($request, $user) {
        if ($request->has('image') && $request->image != null) {
            $image = $request->file('image');
            if ($image && $file = $image->isValid()) {
                $destinationPath = public_path('uploads/profiles/' . $user->id);
                mkdir($destinationPath);
                $destinationPath .= "/";
                $fileName = $image->getClientOriginalName();
                $image->move($destinationPath, $fileName);
                $request->image =asset('uploads/profiles/' . $user->id.'/'.$fileName);

                if (!empty($user->image)) {
                    //delete old image
                    $file = public_path('uploads/profiles/' . $user->id . '/') . $user->image;
                    @unlink($file);
                }
            }
            $user->image = $request->image;
            $user->save();
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'LastName' => 'required',
            'email' => 'required|email|unique:users',
            'country_id' => 'required',
            'mobile' => 'required|numeric|unique:users',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),'Login invalid');
//            return response()->json(["status" => "failed", 'error' => $validator->errors(),'message'=>'Data is invalid'], 401);
        } else {
            if ($request->type == 'applicant') {
                $user = $this->initUser($request);
                $user->type = "applicant";
                $user->is_active = 1;
                $user->save();
                $this->upload($request, $user);
                $user->assignRole('registered-users');
                $applicant = new Applicant();
                $applicant->user_id = $user->id;
                $applicant->address = $request->address;
                $applicant->country_id = $request->country_id;
                $applicant->grade = $request->grade;
                $applicant->education_level = $request->edu_level;
                $applicant->save();
                $data = User::
                leftJoin('applicants','users.id','=','applicants.user_id')
                    ->select('users.*','applicants.education_level','applicants.address','applicants.grade')
                    ->where('users.id',$user->id)
                    ->first();
                $data['image'] = str_replace(' ','%20',$data->image);
                $data['token'] = $user->createToken('MyApp')->accessToken;
                return $this->sendResponse($data,'signUp applicant done');
//                return response()->json(["status" => "ok", "data" => $data,'message'=>'signUp applicant done'], 200);
            } elseif ($request->type == 'trainer') {
                $user = $this->initUser($request);
                $user->is_active = 0;
                $user->type = "trainer";
                $user->save();
                $this->upload($request, $user);
                $user->assignRole('trainer');
                $trainer = new Trainer();
                $trainer->user_id = $user->id;
                $trainer->address = $request->address;
                $trainer->country_id = $request->country_id;
//
                $url = url('/admin/trainer/pending');

                $description = _i('Please Approve');
                $admin = User::where('is_admin', 1)->first();
                $admin->notify(new acceptTrainer($admin->id, $user->first_name, $user->last_name, $description, $url));

                $trainer->save();
                $data = User::
                leftJoin('trainers','users.id','=','trainers.user_id')
                    ->select('users.*','trainers.address')
                    ->where('users.id',$user->id)
                    ->first();
                $data['token'] = $user->createToken('MyApp')->accessToken;
                $data['image'] = str_replace(' ','%20',$data->image);

                return $this->sendResponse($data,'signUp trainer done');
//                return response()->json(["status" => "ok", "data" => $data,'message'=>'signUp trainer done'], $this->successStatus);
            }
        }
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function getDetails(Request $request)
    {
        $user = Auth::user();
        if ($user->type == 'applicant'){
            $data['courses'] =[];
            $data['quizz'] =[];
            $data = User::
            leftJoin('applicants','users.id','=','applicants.user_id')
                ->select('users.*','applicants.education_level','applicants.address','applicants.grade')
                ->where('users.id',$user->id)
                ->first();
            $data['image'] = str_replace(' ','%20',$data->image);


            $cources = DB::table('applicant_course')->
            leftJoin('applicants','applicant_course.applicant_id','=','applicants.id')->
            leftJoin('courses','applicant_course.course_id','=','courses.id')
                ->select(['courses.*','applicants.user_id'])
                ->where('applicants.user_id',$user->id)
                ->where('courses.lang_id',$this->getlang($request->lang))
                ->get();
            foreach ( $cources as $course){
                $course->img = asset('uploads/courses/'.$course->id.'/'.str_replace(' ','%20',$course->img));
                $course->video = asset('uploads/courses/'.$course->id.'/'.str_replace(' ','%20',$course->video));
            }
            $data['courses'] = $cources;

            $quiezz = DB::table('user_exams')
                ->leftJoin('exams','user_exams.exam_id','=','exams.id')
                ->leftJoin('exam_data','exam_data.exam_id','=','exams.id')
                ->select('exams.*','exam_data.title','exam_data.description','exam_data.lang_id')
                ->where('user_exams.user_id','=',$user->id)
                ->where('exam_data.lang_id','=',$this->getlang($request->lang))
                ->where('exams.is_active','=',1)->
                get();

            $data['quizz'] = $quiezz;


        }elseif($user->type == 'trainer'){
            $data = User::
            leftJoin('trainers','users.id','=','trainers.user_id')
                ->select('users.*','trainers.address')
                ->where('users.id',$user->id)
                ->first();

            $data['courses'] = [];
            $cources = DB::table('courses')
                ->where('user_id',$user->id)
                ->where('lang_id',$this->getlang($request->lang))
                ->get();
            foreach ( $cources as $course){
                $course->img = asset('uploads/courses/'.$course->id.'/'.str_replace(' ','%20',$course->img));
                $course->video = asset('uploads/courses/'.$course->id.'/'.str_replace(' ','%20',$course->video));
            }
            $data['courses'] = $cources;
        }
        return $this->sendResponse($data,'Done!!!');
//        return response()->json(["status" => "ok", "data" => $data,'message'=>'Done!!!'], $this->successStatus);
    }

    // getCatefgory
    public function getCategory(Request $request){
        $category = Category::where('parent_id',null)
            ->where('lang_id',$this->getlang($request->lang))
            ->get();
        if($category->count() > 0 ) {
            return $this->sendResponse($category,'Done!!!');
//            return response()->json(["status" => "ok", "data" => $Subcategory,'message'=>'Done!!!'], $this->successStatus);
        }else{
            return $this->sendError('not found data in this category');
//            return response()->json(["status" => "failed", "data" => $Subcategory,'message'=>'not found data in this category'], 401);
        }
//        return response()->json(["status" => "ok", "data" => $category,'message'=>'Done!!!'], $this->successStatus);
//        dd($category);
    }

    //getSubCategory
    Public function getSubCategory(Request $request,$id){
        $Subcategory = Category::where('parent_id',$id)
            ->where('lang_id',$this->getlang($request->lang))
            ->get();
        if($Subcategory->count() > 0 ) {
            return $this->sendResponse($Subcategory,'Done!!!');
//            return response()->json(["status" => "ok", "data" => $Subcategory,'message'=>'Done!!!'], $this->successStatus);
        }else{
            return $this->sendError('not found data in this category');
//            return response()->json(["status" => "failed", "data" => $Subcategory,'message'=>'not found data in this category'], 401);
        }
    }
    // get cource relation with category

    public function getcategoryCourse(Request $request,$id){
        $path = asset('uploads/courses/');
        $course = DB::table('co_category_course')
            ->select(
                'courses.id',
                'courses.title',
                'courses.cost',
//                'courses.currency_id',
//                'courses.lang_id',
//                'countries_courses.country_id',
                DB::raw('CONCAT('."'".$path."'".',"/",courses.id,"/", replace(courses.img," ", "%20")) AS img'),
                DB::raw('CONCAT('."'".$path."'".',"/",courses.id,"/", replace(courses.video," ", "%20")) AS video')
//                DB::raw('CONCAT("/uploads/courses","/",courses.id,"/", courses.img) AS img'),'courses.id',
//                DB::raw('CONCAT("/uploads/courses","/",courses.id,"/", courses.video) AS video'),'courses.id'
            )
            ->leftJoin('courses','co_category_course.course_id','=','courses.id')
            ->leftJoin('countries_courses','courses.id','=','countries_courses.course_id')
            ->where('co_category_id',$id)
            ->where('courses.is_active',1)
            ->where('countries_courses.country_id',$this->getcountry($request->country))
            ->where('courses.lang_id',$this->getlang($request->lang))
            ->where('courses.currency_id',$this->currency($request->currency))
            ->orderBy('id','DESC')->get();

        return $this->sendResponse($course,'Done!!!');

    }

    public function getinstructor(Request $request,$id){
        $path = asset('uploads/profiles/');
        $instructor = DB::table('co_category_course')
            ->select(
                'users.id',
                'courses.lang_id',
                DB::raw('CONCAT(users.first_name," ",users.last_name) AS username'),
                'courses.title as coursename',
                DB::raw('CONCAT('."'".$path."'".',"/",users.id,"/", replace(users.image," ", "%20")) AS imageTranier')
//                DB::raw('CONCAT('."'".$path."'".',"/",users.id,"/", users.image) AS imageTranier')//
//                DB::raw("COUNT(courses.*) as count_click"
            )
            ->leftJoin('courses','co_category_course.course_id','=','courses.id')
            ->leftJoin('users','courses.user_id','=','users.id')
            ->leftJoin('countries_courses','courses.id','=','countries_courses.course_id')

            ->where('co_category_course.co_category_id',$id)
            ->where('users.is_admin','!=',1)
            ->where('users.type','=','trainer')
            ->where('courses.lang_id','=',$this->getlang($request->lang))
            ->where('courses.currency_id',$this->currency($request->currency))
            ->where('countries_courses.country_id',$this->getcountry($request->country))
            ->where('courses.is_active',1)
            ->get();

        return $this->sendResponse($instructor,'Done!!!');
    }

    public function getreviewCourse(Request $request,$id){
        $course =Course::
        where('id',$id)->
        where('lang_id','=',$this->getlang($request->lang))->
        where('currency_id','=',$this->currency($request->currency))->
        with(['coursemedia' => function($q) use ($request){
            $q->where('currency_id',$this->currency($request->currency));
//                where('currency_id',$this->currency($request->currency))
        }])->
        where('id',$id)->
        where('currency_id',$this->currency($request->currency))->
        first();
        if (!empty($course)){
//            $course['img'] = asset('uploads/courses/'.$id.'/'.str_replace(' ','%20',$course->img));
//            $course['video'] = asset('uploads/courses/'.$id.'/'.str_replace(' ','%20',$course->video) );
            $course['type'] = 'course';
            foreach ($course->coursemedia as $path){

//                $path['img'] =  asset('uploads/course_videos/'.$path->id.'/'.str_replace(' ','%20',$path->img));
//                $path['file'] =  asset('uploads/course_videos/'.$path->id.'/'.str_replace(' ','%20',$path->file));
                $data = DB::table('course_media_data')
                    ->where('media_id',$path->id)
                    ->where('lang_id',$this->getlang($request->lang))
                    ->first();

                $path['title'] = $data ? $data->title : '';
                $path['description'] = $data ? $data->description : '';
                $path['type'] = 'media';
            }
        }


        return $this->sendResponse($course,'Done!!!');

    }

    public function getallcources(Request $request){
        $courses = Course::
        leftJoin('countries_courses','courses.id','=','countries_courses.course_id')->
        where('courses.is_active',1)->
        where('countries_courses.country_id',$this->getcountry($request->country))->
        where('courses.lang_id',$this->getlang($request->lang))->
        where('courses.currency_id',$this->currency($request->currency))->
        get([
            'courses.id',
            'courses.img',
            'courses.title',
            'courses.cost',
            'courses.duration',
            'courses.user_id',
            'countries_courses.country_id',
            'courses.currency_id',
        ]);
//            ->get(['id','img','title','cost','duration','user_id']);
//        dd($courses);
        foreach ($courses as $cource){
            $name = \App\User::findOrFail($cource->user_id);
            $cource['user_id'] = $name->first_name.''.$name->last_name;
            $cource['img'] = asset('uploads/courses/'.$cource->id.'/'.str_replace(' ','%20',$cource->img));;
            $cource['cost'] = $cource->cost;
            $cource['duration'] = $cource->duration;

        }
        return $this->sendResponse($courses,'Done!!!');

    }

    public function getquizz(Request $request,$id)
    {
        $exam = Exam::leftJoin('exam_data','exams.id','=','exam_data.exam_id')
            ->select('exams.*','exam_data.title','exam_data.description','exam_data.lang_id')
            ->where('exams.id',$id)
            ->where('exam_data.lang_id',$this->getlang($request->lang))
            ->where('exams.is_active',1)
            ->first();
        if ($exam != null){
            //        $exam['questions'] =[];
            $questions = Exam_Question::where('exam_id',$id)->where('lang_id',$this->getlang($request->lang))
                ->with(['choosen'=>function($query) use ($request){
                    $query->where('lang_id',$this->getlang($request->lang));
                }])->get();
            $exam['questions'] =$questions;
            return $this->sendResponse($exam,'Done!!!');

        }else{
            return $this->sendResponse($exam,'sorry not found questions this exam!!!');

        }
    }


    public function getanswer(Request $request){

//        $user_exam = User_Exam::where('user_id',auth()->id())->first();
//        $exam = Exam::findOrFail($user_exam->exam_id);
//        $questions_exams = Exam_Question::where('exam_id', $exam->id)->where('source_id',null)->pluck('id')->toArray();
//        $user_exam_answer = User_Exam_Answer::where('user_exam_id',$user_exam->id)->pluck('question_id')->toArray();
////        dd($user_exam_answer);
//        foreach($questions_exams as $questions_exam) {
////            in_array($questions_exam,$user_exam_answer);
////            dd($user_exam_answer);
//            if(in_array($questions_exam,$user_exam_answer)) {
//                return redirect()->route('quiz_result',['id',$exam->id]);
//            }
//        }

        if ($request->answer && is_array($request->answer)){
//            dd($request->answer);
            foreach ($request->answer as $key => $values) {
                foreach ($values as $key =>$value){
                    $check = Exam_Question::where('id',$key)->first();
                    if (!empty($check)){
                        $question = Exam_Question::findOrFail($key);
                        if ($question){
                            $user_exam = User_Exam::where('user_id', auth()->id())->where('exam_id', $question->exam_id)->first();
                            $question_choice = Question_choice::where('question_id', $key)->first();

                            if($value == $question_choice->is_answer) {
                                $user_answer[] = User_Exam_Answer::create([
                                    'user_exam_id' => $user_exam->id,
                                    'question_id' => $question_choice->question_id,
                                    'answer_id' => $question_choice->id,
                                    'score' => $question->score,
                                    'created' => Carbon::now(),
                                    'is_answer' => $value,
                                ]);
                            } else {
                                $user_answer[] = User_Exam_Answer::create([
                                    'user_exam_id' => $user_exam->id,
                                    'question_id' => $question_choice->question_id,
                                    'answer_id' => $question_choice->id,
                                    'score' => 0,
                                    'created' => Carbon::now(),
                                    'is_answer' => $value,
                                ]);
                            }
                        }else{
                            return $this->sendError('not found this questions');
                        }
                    }else {
                        return $this->sendError('not found this questions');
                    }
                }
            }
            $data['score'] = array_sum(array_column($user_answer, 'score'));
            return $this->sendResponse($data,'Done!!!');

        }else{
            return $this->sendError('Sorry you should enter data');
        }

    }

    public function quiz_result(){

        $user_exam = User_Exam::where('user_id',auth()->id())->first();
        if ($user_exam){
            $user_answer_score = User_Exam_Answer::where('user_exam_id', $user_exam->id)->sum('score');
            $user_answer_wrong = User_Exam_Answer::where('user_exam_id', $user_exam->id)->where('score', 0)->count();
            $user_answer_correct = User_Exam_Answer::where('user_exam_id', $user_exam->id)->where('score', '!=', 0)->count();
            $user_exam_check = User_Exam::where('user_id',auth()->id())->where('exam_id',$user_exam->exam_id)->exists();

            if($user_exam_check == true) {
                $quizzes = Exam_Question::where('exam_id', $user_exam->exam_id)->where('source_id', null)->get();
            }
            $data = [
                'user_answer_score' => $user_answer_score,
                'user_answer_wrong' => $user_answer_wrong,
                'user_answer_correct' => $user_answer_correct,
            ];
            $data['quizzes'] = $quizzes;
            return $this->sendResponse($data,'Done!!!');
        }else{
            return $this->sendError('Sorry not find exam this user');

        }

    }


    public function contacts(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'name' => 'required',
            'message' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors(),'Login invalid');
//            return response()->json(["status" => "failed", "error" => $validator->errors(),'message' => 'Login invalid'], 401);
        }

        $data = DB::table('contacts')->insert([
            'name' =>$request->name,
            'email' =>$request->email,
            'message' =>$request->message,
        ]);

        return $this->sendResponse($data,'Done massege send suessfly!!!');

    }

    public function getpayment(Request $request){
        if($request->item_type == 'course') {
            if($request->bank_id)
            {
                $order = Orders::create([
                    'user_id' => auth()->user()->id,
                ]);
                $order->save();

                $id = $request->item_id;
                $check =  Course::where('id',$id)->first();
                if ($check){
                    $transaction = transactions::create([
                        'order_id' => $order->id,
                        'status' => "pending",
                        'bank_id' => $request->bank_id,
                        'transaction_no' => $request->transaction_no,
                        'total' => $request->item_price,
                        'currency_id' => Currency::where('title' ,$request->item_currency)->first()->id,
                    ]);
//                    $transaction->save();
                    $order_course = OrderCourses::create([
                        'course_id' => $request->item_id,
                        'type' => $request->item_type,
                        'order_id' => $order->id,
                        'price' => $request->item_net_price,
                        'currency_id' => Currency::where('title' ,$request->item_currency)->first()->id,
                    ]);
//                    dd($order_course);
//                    $order_course->save();
                }else{
                    return $this->sendError('Sorry this course not found');
                }
            }
            $transaction->type = 'course';
            return $this->sendResponse($transaction,'Done massege send suessfly!!!');
        }

        if($request->item_type == 'media') {
            if($request->bank_id)
            {
                $order = Orders::create([
                    'user_id' => auth()->user()->id,
                ]);
                $order->save();

                $id = $request->item_id;
                $check =  Course::where('id',$id)->first();
                if ($check) {
                    $transaction = transactions::create([
                        'order_id' => $order->id,
                        'status' => "pending",
                        'bank_id' => $request->bank_id,
                        'transaction_no' => $request->transaction_no,
                        'total' => $request->item_price,
                        'currency_id' => Currency::where('title', $request->item_currency)->first()->id,
                    ]);
//                    $transaction->save();

                    $order_course = OrderCourses::create([
                        'course_id' => $request->item_id,
                        'type' => $request->item_type,
                        'order_id' => $order->id,
                        'price' => $request->item_net_price,
                        'currency_id' => Currency::where('title', $request->item_currency)->first()->id,
                    ]);
//                    $order_course->save();
                }
            }
            $transaction->type = 'media';
            return $this->sendResponse($transaction,'Done massege send suessfly!!!');
        }
    }

    public function getbank(Request $request){
        $banks = DB::table('bank_transfers')
            ->where('lang_id',$this->getlang($request->lang))
            ->get();

        if ($banks->count() > 0){

            return $this->sendResponse($banks,'Done !!!');
        }else{
            return $this->sendError('not found data');
        }


    }

    public function getcurrency(Request $request){
        $currency = DB::table('currencies')
            ->where('lang_id',$this->getlang($request->lang))
            ->get();

        if ($currency->count() > 0){

            return $this->sendResponse($currency,'Done !!!');
        }else{
            return $this->sendError('not found data');
        }


    }

    public function getcountrydata(Request $request){
        $country = DB::table('countries')
            ->where('lang_id',$this->getlang($request->lang))
            ->get();
//        $country['logo'] =  asset('uploads/countries/'.$coun->id.'/',$coun->logo);

        foreach ($country as $coun){
            $coun->logo = asset('uploads/countries/'.$coun->id.'/'.$coun->logo);
        }
//        dd($country);

        if ($country->count() > 0){

            return $this->sendResponse($country,'Done !!!');
        }else{
            return $this->sendError('not found data');
        }
    }

    public function edulevel(Request $request){
        $edu = DB::table('education_levels')
            ->where('lang_id',$this->getlang($request->lang))
            ->where('country_id',$this->getcountry($request->country))
            ->get();
//        $country['logo'] =  asset('uploads/countries/'.$coun->id.'/',$coun->logo);

//        dd($country);
        if ($edu->count() > 0){

            return $this->sendResponse($edu,'Done !!!');
        }else{
            return $this->sendError('not found data');

        }

    }

    public function search(Request $request){
//        $country = Countries::findOrFail($this->getcountry($request->country));
        if($request->parent_cat && $request->child_cat == null && $request->search_key == null)
        {
            $categories = Co_category::where('id' , '=', $request->parent_cat)
                ->where('lang_id' , $this->getlang($request->lang))
                ->orderBy('id', 'desc')->paginate(6);

            return $this->sendResponse($categories,'Done !!!');
        }
        elseif($request->parent_cat && $request->child_cat && $request->search_key == null)
        {

            $category = Co_category::where('id' , $request->parent_cat)->where('parent_id' , $request->child_cat)->first();
            if ($category){
                $courses = Course_co_category::leftJoin('courses','courses.id','co_category_course.course_id')
                    ->leftJoin('countries_courses','countries_courses.course_id','courses.id')
                    ->where('co_category_course.co_category_id', $category->id)
                    ->where('countries_courses.country_id',$this->getcountry($request->country))
                    ->where('courses.is_active', 1)
                    ->where('courses.lang_id',$this->getlang($request->lang))
                    ->select('courses.*','countries_courses.country_id','co_category_course.co_category_id')
                    ->paginate(6);
                foreach ($courses as $cource){
                    $cource['img'] = asset('uploads/courses/'.$cource->id.'/'.str_replace(' ','%20',$cource->img));
                    $cource['video'] = asset('uploads/courses/'.$cource->id.'/'.str_replace(' ','%20',$cource->video));
                }
                return $this->sendResponse($courses,'Done !!!');
            }else{
                return $this->sendError('not found data');
            }

        }
        elseif($request->parent_cat && $request->child_cat && $request->search_key)
        {

            $category = Co_category::where('id' , $request->parent_cat)->where('parent_id' , $request->child_cat)->first();

            if ($category){

                $courses = Course_co_category::
                leftJoin('courses','courses.id','co_category_course.course_id')
                    ->leftJoin('countries_courses','countries_courses.course_id','courses.id')
                    ->where('co_category_course.co_category_id', $category->id)
                    ->where('countries_courses.country_id',$this->getcountry($request->country))
                    ->where('courses.is_active', 1)
                    ->where('courses.lang_id', $this->getlang($request->lang))
                    ->where('courses.title','LIKE', '%'.$request->search_key.'%')
                    ->select('courses.*','countries_courses.country_id','co_category_course.co_category_id')
                    ->paginate(6);

                foreach ($courses as $cource){
                    $cource['img'] = asset('uploads/courses/'.$cource->id.'/'.str_replace(' ','%20',$cource->img));
                    $cource['video'] = asset('uploads/courses/'.$cource->id.'/'.str_replace(' ','%20',$cource->video));
                }

                return $this->sendResponse($courses,'Done !!!');
            }else{
                return $this->sendError('not found data');

            }
//            dd(count($courses));
        }
        elseif( ($request->parent_cat && $request->search_key) || ($request->search_key ) )
        {

            $courses = Course::leftJoin('countries_courses','countries_courses.course_id','courses.id')
                ->where('countries_courses.country_id',$this->getcountry($request->country))
                ->where('courses.is_active', '=', 1)
                ->where('courses.lang_id',$this->getlang($request->lang))
                ->where('courses.title','like', "%$request->search_key%")
                ->orderBy('courses.id', 'desc')
                ->select('courses.*','countries_courses.country_id')
                ->paginate(6);
            foreach ($courses as $cource){
                $cource['img'] = asset('uploads/courses/'.$cource->id.'/'.str_replace(' ','%20',$cource->img));
                $cource['video'] = asset('uploads/courses/'.$cource->id.'/'.str_replace(' ','%20',$cource->video));

            }
            return $this->sendResponse($courses,'Done !!!');
        }else{

            return $this->sendError('not found data');
        }
    }
    public function lang(Request $request){
        $lang = DB::table('languages')
            ->get();

        if ($lang->count() > 0){

            return $this->sendResponse($lang,'Done !!!');
        }else{
            return $this->sendError('not found data');

        }
    }

    public function myCourses(Request $request){
        $user = Auth::user();
//        dd($user);
        $applicant_id = Applicant::where('user_id',$user->id)->value('id');
        if ($user->type == 'applicant'){

            $course =ApplicantCourse::
            where('applicant_id',$applicant_id)->
            // cources relation
            with(['course'=>function ($q) use($request){
                $q->where('lang_id',$this->getlang($request->lang_id));
                $q->where('currency_id',$this->currency($request->currency));
                // course media relation
                $q->with(['coursemedia'=>function($m) use ($request){
                    $m->where('currency_id',$this->currency($request->currency));
                    $m->with(['coursemediadata'=>function($p) use($request){
                        $p->where('lang_id',$this->getlang($request->lang_id));
                    }]);
                }]);
                // quizz relation
                $q->with(['quizz'=>function($query) use($request){
                    $query->with(['exam_data'=>function($d) use($request){
                        $d->where('lang_id',$this->getlang($request->lang_id));
                    }]);
                }]);
            }])->get();
//                   dd($course);
        }elseif($user->type == 'trainer'){

            $course =Course::
            where('user_id',$user->id)->
            where('lang_id','=',$this->getlang($request->lang_id))->
            where('currency_id','=',$this->currency($request->currency))->
            with(['coursemedia'=>function($m) use ($request){
                $m->where('currency_id',$this->currency($request->currency));
                $m->with(['coursemediadata'=>function($p) use($request){
                    $p->where('lang_id',$this->getlang($request->lang_id));
                }]);
            }])
                // quizz relation
                ->with(['quizz'=>function($query) use($request){
                    $query->with(['exam_data'=>function($d) use($request){
                        $d->where('lang_id',$this->getlang($request->lang_id));
                    }]);
                }])->get();
        }
        if ($course->count() > 0){
            return $this->sendResponse($course,'Done !!!');
        }else{
            return $this->sendError('not found data');

        }
    }

    public function myQuizz(Request $request){
        $user = Auth::user();
        $quizz = User_Exam::where('user_id',$user->id)
            ->leftJoin('exams','user_exams.exam_id','=','exams.id')
            ->leftJoin('exam_data','exam_data.exam_id','=','exams.id')

            ->where('exam_data.lang_id',$this->getlang($request->lang_id))
            ->select(['exams.*','exam_data.title','exam_data.description','exam_data.lang_id'])
            ->get();


        if ($quizz->count() > 0){
            return $this->sendResponse($quizz,'Done !!!');
        }else{
            return $this->sendError('not found data');

        }

    }

    // slider

    public function slider(Request $request){

        $sliders = DB::table('galleries')
            ->where('published',1)
            ->where('lang_id',$this->getlang($request->lang))
            ->get();

        foreach($sliders as $slider){
            $slider->href = asset('uploads/Gallery/'.$slider->id.'/'.str_replace(' ','%20',$slider->href));
            //  dd($slider->href);
        }
        if ($sliders){
            return $this->sendResponse($sliders,'Done !!!');
        }else{
            return $this->sendError('not found data');
        }
    }

    public function popularCourse(Request $request){
//        dd( $this->getlang($request->lang));
        $courses = Course::leftJoin('countries_courses', 'countries_courses.course_id', 'courses.id')
            ->where('countries_courses.country_id', $this->getcountry($request->country))
            ->where('courses.is_active', '=', 1)
            ->where('courses.lang_id', $this->getlang($request->lang))
            ->orderBy('courses.id', 'desc')
            ->select('courses.*', 'countries_courses.country_id')
            ->take(10)->latest()->get();
//        dd($courses);
        if ($courses->count() > 0){
            return $this->sendResponse($courses,'Done !!!');
        }else{
            return $this->sendError('not found data');
        }
    }


    public function popularCategoryCourse(Request $request,$id){

        $path = asset('uploads/courses/');
        $course = DB::table('co_category_course')
            ->select(
                'courses.id',
                'courses.title',
                'courses.cost',
                'courses.created_at',
//                'courses.currency_id',
//                'courses.lang_id',
//                'countries_courses.country_id',
                DB::raw('CONCAT('."'".$path."'".',"/",courses.id,"/", replace(courses.img," ", "%20")) AS img'),
                DB::raw('CONCAT('."'".$path."'".',"/",courses.id,"/", replace(courses.video," ", "%20")) AS video')
//                DB::raw('CONCAT("/uploads/courses","/",courses.id,"/", courses.img) AS img'),'courses.id',
//                DB::raw('CONCAT("/uploads/courses","/",courses.id,"/", courses.video) AS video'),'courses.id'
            )
            ->leftJoin('courses','co_category_course.course_id','=','courses.id')
            ->leftJoin('countries_courses','courses.id','=','countries_courses.course_id')
            ->where('co_category_course.co_category_id',$id)
            ->where('courses.is_active',1)
            ->where('countries_courses.country_id',$this->getcountry($request->country))
            ->where('courses.lang_id',$this->getlang($request->lang))
//            ->where('courses.currency_id',$this->currency($request->currency))
            ->latest()
            ->take(10)->get();

        if ($course->count() > 0){
            return $this->sendResponse($course,'Done !!!');
        }else{
            return $this->sendError('not found data');
        }

    }




}
