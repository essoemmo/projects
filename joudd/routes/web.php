<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */
//Route::get('/run', function () {
//    $exitCode =Artisan::call('storage:link');
//    echo $exitCode;
//});

//include("admin.php");

Route::get('/clear', function () {

    Artisan::call('cache:clear');
    //\Artisan::call('optimize');

    dd("Cache is cleared");

});

Route::get('lang/{lang}','HomeController@lang'); // set language

Route::get('/', 'HomeController@index');
Route::get('/article_categories', 'HomeController@article_categories'); // all article categories
Route::get('/article_cat/{cat_id}', 'HomeController@article_cat'); // all article under custom category
Route::get('/article/{article_id}', 'HomeController@article'); // all article under custom category

Route::get('/courses', 'HomeController@courses');
Route::get('/course/{id}', 'HomeController@course')->name('single_course');
Route::get('/course_media/{id}', 'HomeController@courseMedia')->name('single_courseMedia');
Route::get('/enroll/{id}', 'HomeController@enroll')->name('enroll');
Route::get('/enroll_media/{id}', 'HomeController@enrollMedia')->name('enrollMedia');
Route::get('/subscribe/{id}', 'HomeController@subscribe')->name('subscribe');
Route::get('/subscribe_media/{id}', 'HomeController@subscribeMedia')->name('subscribeMedia');
Route::get('/categories', 'HomeController@categories');
Route::get('/category/{id}', 'HomeController@category');
Route::get('/category/parent/{id}', 'HomeController@category_parent');
Route::get('/child_cat/list', 'Front\SearchController@child_categories'); // used for ajax
Route::get('/search', 'Front\SearchController@search'); // used for ajax

Route::get('/choose', 'Front\auth\RegisterController@choose');
Route::get('/signUp', 'Front\auth\RegisterController@signUp');
//Route::get('/signUp/teacher', 'Front\auth\RegisterController@teacher');
Route::post('/signUp/store', 'Front\auth\RegisterController@store');

Route::get('/showVideo', 'HomeController@showVideo');

Route::get('countries', 'Front\ChangeController@countries')->name('web.countries');
Route::get('change_countries', 'Front\ChangeController@changeCountries');

Route::get('/user/allMessages','MessageController@allMessages')->name('web.messages');

Route::get('/competitions', 'HomeController@competitions');

Route::get('/educationlevel/list', 'Front\User\DashboardController@educationLevelList');// education level list


//Route::get('/home', 'AdminController@index')->name('home');
Route::group(['middleware' => ['web', 'auth']], function() {

    Route::group(['prefix'=>'user'] , function(){

        Route::get('/logout', 'Front\User\LoginController@logout'); // user logout

        Route::get('/courseRequest/showForm','Front\User\CourseRequestController@showForm')->name('courseRequestShow');

        Route::post('/read_only','MessageController@read_only');

        Route::group(['middleware' => 'applicant'] , function (){
            Route::get('/buy/{type}/{id}', 'Front\User\BuyController@buy')->name('buy');
            Route::post('/payment/offline', 'Front\User\BuyController@payment_offline');
            Route::post('/payment/online', 'Front\User\BuyController@payment_online');
            Route::get('bank/details', 'Front\User\BuyController@bank_details');

            Route::get('/pendingcourses', 'Front\User\DashboardController@myPendingCourses');


            Route::get('/pending/{id}', 'Api\Applicants\ApplicantController@ApplicantApproval');
            Route::post('/pendingcourse/delete', 'Api\Applicants\ApplicantController@deleteCoursePending'); // applicant delete course pending
            Route::get('/my_courses', 'Front\User\MyCoursesController@myCourses'); // return user folder => Courses page
            Route::get('/my/{id}', 'Api\Applicants\ApplicantController@myCourses');
            Route::get('/course/attach/{course_id}', 'Front\User\DashboardController@course_attachments'); // show attachments to course

            Route::resource('/courseRequest','Front\User\CourseRequestController');
            Route::POST('/courseRequest/{id}/update','Front\User\CourseRequestController@update');
            Route::delete('/courseRequest/{id}/delete','Front\User\CourseRequestController@destroy');

            Route::get('/myBills','Front\User\MyBillController@index');
            Route::get('/myBills/{id}/cancel' ,'Front\User\MyBillController@cancel');
            Route::get('/myBills/{id}/pay' ,'Front\User\MyBillController@pay');


            Route::post('/subscribe/newsletters', 'Front\WelcomeController@userSubscribeNewsLetters'); // user subscribe news letters
            Route::post('/notsubscribe', 'Front\WelcomeController@deleteSubscriber'); // delete subscriber from news letters

            Route::post('/send_message','MessageController@userSend');
            Route::get('/userMessages/{id}','MessageController@userMessages');
            Route::get('/get_messages_from_id','MessageController@get_messages');
// teacher

            Route::get('/quizzes','Front\ExamController@index');
            Route::get('/quiz/{id}','Front\ExamController@single_quiz')->name('single_quiz');
            Route::get('/quiz_join/{id}','Front\ExamController@quiz_join')->name('quiz_join');
            Route::post('/quiz/check','Front\ExamController@quiz_check');
            Route::get('/quiz/result/{id}','Front\ExamController@quiz_result')->name('quiz_result');


        });


        Route::group(['middleware' => 'trainer'] , function (){

            Route::get('/course/create', 'Hr\Course\CourseController@create')->middleware('permission:Course-Add'); // show form to add course
            Route::get('/course/create', 'Hr\Course\CourseController@create')->middleware('permission:Course-Add'); // show form to add course
            Route::post('/course/create', 'Hr\Course\CourseController@postCreate')->middleware('permission:Course-Add'); // store new course
            Route::get('/created','Hr\Course\CourseController@createdCourses')->middleware('permission:Course-Edit|Course-Delete');
            Route::get('/pending','Hr\Course\CourseController@createdCourses')->middleware('permission:Course-Edit|Course-Delete');
//            Route::get('/course/{id}/edit','Hr\Course\CourseController@teacherEditCourse')->middleware('permission:Course-Edit|Course-Delete'); // teacher edit course
//            Route::post('/course/{id}/edit', 'Hr\Course\CourseController@teacherUpdateCourse')->middleware('permission:Course-Edit');
            Route::get('/myCourses/get_user_datatable', 'Hr\Course\CourseController@getUserDataTable')->middleware('permission:Course-Edit|Course-Delete');
            Route::get('/myCourses/get_user_pendingCourse_datatable', 'Hr\Course\CourseController@getUserDataTable')->middleware('permission:Course-Edit|Course-Delete');

// course video
            Route::get('/course/{id}/video', 'Hr\Course\CourseController@teacherAddCourseVideo')->middleware('permission:Course-Video'); // add videos to course
            Route::post('/course/{id}/video', 'Hr\Course\CourseController@storeCourseVideo')->middleware('permission:Course-Video'); // add videos to course

            Route::get('/course/video/{id}/edit', 'Hr\Course\CourseController@teacherEditVideo')->middleware('permission:Course-Video'); //edit videos to course
            Route::post('/course/video/{id}/update', 'Hr\Course\CourseController@updateVideo')->middleware('permission:Course-Video'); //edit videos to course
            Route::get('/course/videos/{course_id}', 'Hr\Course\CourseController@datatableVideos')->middleware('permission:Course-Video');
            Route::delete('/course/video/delete/{id}', 'Hr\Course\CourseController@deleteVideo')->middleware('permission:Course-Video'); //delete videos to course
            Route::get('/course/media_tag/delete', 'Hr\Course\CourseController@deleteTag')->middleware('permission:Course-Video')->name('teacherTag.destroy');


// exams
            Route::get('/course_exam/all', 'Hr\Course\TrainerController@teacherExams')->middleware('permission:Course-Exam-Edit|Course-Exam-Delete');
            Route::get('/course_exam/all/get_datatable', 'Hr\Course\TrainerController@getDatatableTeacherExams')->middleware('permission:Course-Exam-Edit|Course-Exam-Delete');
            Route::get('/course/{id}/course_exam/create', 'Hr\Course\TrainerController@teacherCreateExam')->middleware('permission:Course-Exam-Add');
            Route::post('/course/{id}/course_exam/store', 'Hr\Course\CourseExamController@store')->middleware('permission:Course-Exam-Add');
            Route::get('/course/course_exam/{id}/edit', 'Hr\Course\TrainerController@teacherEditCourseExam')->middleware('permission:Course-Exam-Edit');
            Route::post('/course/course_exam/{id}/update', 'Hr\Course\CourseExamController@update')->middleware('permission:Course-Exam-Edit');

        });



    });


    Route::get('/course/evaluate/{course_id}', 'Front\User\DashboardController@evaluateCourse'); // evaluate course
    Route::post('/course/evaluate/{course_id}', 'Front\User\DashboardController@evaluateCoursePost'); // evaluate course
    Route::get('/trainer/evaluate/{course_id}', 'Front\User\DashboardController@evaluateTrainer'); // evaluate trainer
    Route::post('/trainer/evaluate/{course_id}', 'Front\User\DashboardController@evaluateCoursePost'); // evaluate trainer

    /* ================================== course evaluaton ============== */
    Route::get('/course/questions/{course_id}', 'Api\Courses\Course_evaluationController@getCourseQuestions');
    Route::get('/trainer/questions/{course_id}', 'Api\Courses\Course_evaluationController@getTrainerQuestions');

    /* ======================== user rating ======================= */
    Route::post('rating', 'Front\User\DashboardController@rating')->name('rating');
    Route::post('sendComment' , 'Front\User\DashboardController@sendComment')->name('sendcomment');


    Route::post('addToFavorite', 'Front\User\DashboardController@addToFavorite');
    Route::get('favorite', 'Front\User\DashboardController@favorite');

    /* ==================================== course comments ==================== */
    Route::post('/course_comment/{course_id}' , 'Front\User\DashboardController@storeCourseComment');

    /* ============================ profile  section =============================== */
    Route::get('/profile' , 'Front\User\UserController@showProfileForm')->name('profile');
    Route::post('/profile' , 'Front\User\UserController@profile');
    Route::post('/update_password' , 'Front\User\UserController@update_password');

});

/* ====================================== contacts ==========================*/
Route::get('/contact', 'HomeController@contact');
Route::post('/contact' , 'HomeController@storeContact');


Route::get('user/login', 'Auth\LoginController@showUserLoginForm')->name('website');
Route::post('user/login', 'Auth\LoginController@UserLogin');


    Route::get('/admin/gallery/all', 'GalleryController@all')->middleware('permission:Gallery-Edit|Gallery-Delete');
    Route::get('/admin/gallery/getdatatable', 'GalleryController@getDatatableGallery')->middleware('permission:Gallery-Edit|Gallery-Delete');


Route::post('/user/subscribe/newsletters', 'Front\WelcomeController@userSubscribeNewsLetters'); // user subscribe news letters
Route::post('/user/notsubscribe', 'Front\WelcomeController@deleteSubscriber'); // delete subscriber from news letters

//Route::get('test' , function (){
//    $user = auth()->user();
//    return view('front.user.profile' ,compact('user'));
//});




//
///*=======================================Job===========================*/
//
//Route::get('/test' ,  function(){
//    $benficarys = \Illuminate\Support\Facades\DB::table('benficarys')
//        ->select('benficarys.id as pid', 'benficarys.name', 'benficarys.personal_id', 'benficarys.phone_number',
//            'benficarys.email', 'benficarys.gender', 'benficarys.birth_date')
//        ->join('benficary_membership','benficarys.id','=','benficary_membership.benficary_id')
//        ->where("benficary_membership.membership_id", 3)->toSql();
//    dd($benficarys);
//});

//
//Route::get('qrcode', function () {
//
//    return QrCode::size(300)->generate('A basic example of QR code!');
//});


