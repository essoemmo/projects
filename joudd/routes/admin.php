<?php



Auth::routes();

Route::get('/adminpanel/login', 'Auth\LoginController@showAdminLoginForm');
Route::post('/adminpanel/login', 'Auth\LoginController@adminLogin');

Route::get('/courseRequest/showAdmin','Admin\CourseRequestController@showForm')->name('courseRequestShowAdmin');

Route::get('/admin/allMessages','MessageController@allMessages');

Route::group(['middleware'=>'auth'] , function (){
    Route::get('/home', 'AdminController@index')->middleware('permission:AdminPanel-Show')->name('home');
});

//Route::get('/admin', function () {
//    return view('auth.login');
//});
/* Show */
Route::get('/adminpanel/courses/applicant/info', 'Hr\Course\ApplicantController@getApplicantInfo')->name('info_applicant');

Route::get('/admin/logout', 'AdminController@logOut');

//    Route::view('/home', 'home')->middleware('auth');
Route::group(['prefix'=>'admin','middleware'=>['auth' ,'admin']],function (){

//    Route::get('/lang/{lang}','HomeController@lang')->middleware('permission:Language-Change'); // set language
    Route::get('/lang/{lang}','Admin\SettingsController@lang')->middleware('permission:Language-Change'); // set language adminLang


    // ========================== translate ==================================//
//    Route::get('/translate','Admin\translation\TranslationController@index')->name('translation.index');
//    Route::post('/translate','Admin\translation\TranslationController@store')->name('translation.store');
//    Route::get('/translation/{id}','Admin\translation\TranslationController@show')->name('translation.show');

    /*Translation*/
    Route::group([], function () {
        Route::resource('translation', 'Admin\translation\TranslationController');
        //Hotel
        Route::group(['prefix' => 'translation/hotel'], function () {
            Route::get('/all', 'Admin\translation\advanced\TranslateHotelController@hotels');
            Route::get('/info', 'Admin\translation\advanced\TranslateHotelController@gethotelInfo');
            Route::post('/', 'Admin\translation\advanced\TranslateHotelController@store');
        });
    });


// ========================== groups ==================================//
    Route::get('/groups/all', 'Admin\GroupsController@index')->middleware('permission:Groups-Edit|Groups-Add|Groups-Delete');
    Route::post('/groups/add', 'Admin\GroupsController@add')->middleware('permission:Groups-Add');
    Route::get('/groups/{id}/edit', 'Admin\GroupsController@edit')->middleware('permission:Groups-Edit');
    Route::post('/groups/update', 'Admin\GroupsController@update')->middleware('permission:Groups-Edit');
    Route::get('/groups/delete', 'Admin\GroupsController@delete')->middleware('permission:Groups-Delete');
//    Route::get('/groups/list' , 'Admin\GroupsController@list');




    Route::get('/notification/to', 'NotificationController@notification')->name('notify.send')->middleware('permission:Notification-Show');
    Route::post('/notification/to/store', 'NotificationController@store_notification');
    Route::post('/notify_read','NotificationController@notify_read')->middleware('permission:Notification-Show');

//    Route::get('/admin/login', 'auth\LoginController@showAdminLoginForm');
//    Route::post('/admin/login', 'auth\LoginController@adminLogin');

    Route::post('/send_message','MessageController@userSend')->middleware('permission:UserMessage-Controll');
    Route::post('/read_only','MessageController@read_only')->middleware('permission:UserMessage-Controll');
    Route::get('/adminMessages/{id}','MessageController@adminMessages')->middleware('permission:UserMessage-Controll');
    Route::get('/get_messages_from_id','MessageController@get_messages')->middleware('permission:UserMessage-Controll');

    Route::get('/bills/all', 'Admin\BillController@index')->middleware('permission:Bill-Edit|Bill-Add|Bill-Delete');
    Route::get('/bills/get_datatable' , 'Admin\BillController@get_datatable')->middleware('permission:Bill-Edit|Bill-Add|Bill-Delete');
    Route::get('/bills/create' , 'Admin\BillController@create')->middleware('permission:Bill-Add');
    Route::post('/bills/store' , 'Admin\BillController@store')->middleware('permission:Bill-Add');
    Route::get('/bills/{id}/edit' , 'Admin\BillController@edit')->middleware('permission:Bill-Edit');
    Route::post('/bills/{id}/update' , 'Admin\BillController@update')->middleware('permission:Bill-Edit');
    Route::delete('/bills/{id}/delete' , 'Admin\BillController@destroy')->middleware('permission:Bill-Delete');

    Route::get('/competition/all', 'Admin\CompetitionController@index')->middleware('permission:Competition-Edit|Competition-Add|Competition-Delete');
    Route::get('/competition/get_datatable' , 'Admin\CompetitionController@get_datatable')->middleware('permission:Competition-Edit|Competition-Add|Competition-Delete');
    Route::get('/competition/create' , 'Admin\CompetitionController@create')->middleware('permission:Competition-Add');
    Route::post('/competition/store' , 'Admin\CompetitionController@store')->middleware('permission:Competition-Add');
    Route::get('/competition/{id}/edit' , 'Admin\CompetitionController@edit')->middleware('permission:Competition-Edit');
    Route::post('/competition/{id}/update' , 'Admin\CompetitionController@update')->middleware('permission:Competition-Edit');
    Route::delete('/competition/{id}/delete' , 'Admin\CompetitionController@destroy')->middleware('permission:Competition-Delete');

    Route::get('/competition/{id}/competition/create', 'Admin\CompetitionController@create_exam')->middleware('permission:Course-Exam-Add');
    Route::post('/competition/{id}/competition/store', 'Admin\CompetitionController@store_exam')->middleware('permission:Course-Exam-Add');
    Route::get('/competition/competition/{id}/edit', 'Admin\CompetitionController@edit_exam')->middleware('permission:Course-Exam-Edit');
    Route::post('/competition/competition/{id}/update', 'Admin\CompetitionController@update_exam')->middleware('permission:Course-Exam-Edit');
    Route::get('competition/competition/{id}/delete', 'Admin\CompetitionController@delete_exam')->middleware('permission:Course-Exam-Delete'); //delete videos to course
    Route::post('/choice_change_competition','Admin\CompetitionController@choice_change_exam')->middleware('permission:Course-Exam-Add');


    Route::get('/course/bank_transfer/all', 'Hr\Course\BankTransferController@index')->middleware('permission:BankTransfer-Edit|BankTransfer-Add|BankTransfer-Delete');
    Route::get('/course/bank_transfer/get_datatable', 'Hr\Course\BankTransferController@getDatatableBankTransfer')->middleware('permission:BankTransfer-Edit|BankTransfer-Add|BankTransfer-Delete');
    Route::post('/course/bank_transfer/add', 'Hr\Course\BankTransferController@add')->middleware('permission:BankTransfer-Add');
    Route::post('/course/bank_transfer/update', 'Hr\Course\BankTransferController@update')->middleware('permission:BankTransfer-Edit');
    Route::get('/course/bank_transfer/delete', 'Hr\Course\BankTransferController@delete')->middleware('permission:BankTransfer-Delete');


//    transaction type
    Route::get('transaction_type/all','Admin\transaction\TransactionTypesController@index')->middleware('permission:TransactionType-Add|TransactionType-Edit|TransactionType-Delete');
    Route::get('transaction_type/get_datatable','Admin\transaction\TransactionTypesController@get_datatable')->middleware('permission:TransactionType-Add|TransactionType-Edit|TransactionType-Delete');
    Route::post('transaction_type/update','Admin\transaction\TransactionTypesController@update')->middleware('permission:TransactionType-Edit');
    Route::post('transaction_type/store','Admin\transaction\TransactionTypesController@store')->name('transactionType.store')->middleware('permission:TransactionType-Edit');
    Route::get('transaction_type/delete','Admin\transaction\TransactionTypesController@destroy')->name('transactionType.destroy')->middleware('permission:TransactionType-Delete');

    //orders
    Route::get('orders/offline/all','Admin\Order\OrdersController@offline_orders')->middleware('permission:Transactions-Show');
    Route::get('orders/offline/datatable','Admin\Order\OrdersController@offline_datatable')->middleware('permission:Transactions-Show');
    Route::get('orders/offline/{id}/show','Admin\Order\OrdersController@show_offline')->middleware('permission:Transactions-Show');
    Route::get('orders/offline/{id}/accept','Admin\Order\OrdersController@accept')->middleware('permission:Transactions-Show');
    Route::get('orders/offline/{id}/refused','Admin\Order\OrdersController@refused')->middleware('permission:Transactions-Show');

    Route::get('orders/online/all','Admin\Order\OrdersController@online_orders')->middleware('permission:Transactions-Show');
    Route::get('orders/online/datatable','Admin\Order\OrdersController@online_datatable')->middleware('permission:Transactions-Show');
    Route::get('orders/online/{id}/show','Admin\Order\OrdersController@show_online')->middleware('permission:Transactions-Show');

    Route::delete('orders/{id}/delete','Admin\Order\OrdersController@destroy')->name('order.destroy');


    /* ============================ Admin Panel ============================ */
    Route::get('/admin', 'AdminController@index');
    /* ============================ permission ============================ */
    Route::get('/permission/create', 'AdminController@addPermission')->middleware('permission:Permission-Add');
    Route::post('/permission/create', 'AdminController@storePermission')->middleware('permission:Permission-Add'); // add permission
    Route::get('/permissions', 'AdminController@allPermissions')->middleware('permission:Permission-Edit|Permission-Delete'); // all permissions
    Route::get('/permissions/get_datatable', 'AdminController@getDatatablePermission'); // get all permission with datatable
    Route::get('/permission/{id}/edit', 'AdminController@editPermission')->middleware('permission:Permission-Edit'); // edit permission
    Route::post('/permission/{id}/edit', 'AdminController@updatePermission')->middleware('permission:Permission-Edit'); // update permission
    Route::get('/permission/{id}/delete', 'AdminController@deletePermission')->middleware('permission:Permission-Delete'); // delete permission

    /* ============================ Role ============================ */
    Route::get('/userRoles', 'AdminController@getUserRoles'); // get roles associated with user
    Route::get('/allRoles', 'AdminController@getAllRoles')->middleware('permission:Role-Edit|Role-Delete'); // get all roles
    Route::get('/roles/get_datatable', 'AdminController@getDatatableRoles'); // get all roles with datatable

    Route::get('/role/{id}/edit', 'AdminController@editGroup')->middleware('permission:Role-Edit'); // send data to edit page
    Route::post('/role/{id}/edit', 'AdminController@updateGroup')->middleware('permission:Role-Edit'); // update roles through data get from edit page
    Route::get('/role/{id}/delete', 'AdminController@deleteGroup')->middleware('permission:Role-Delete'); // update roles through data get from edit page

    Route::get('/group/add', 'AdminController@addGroup')->middleware('permission:Role-Add'); // add roles & permissions
    Route::post('/group/add', 'AdminController@storeGroup')->middleware('permission:Role-Add'); // store created roles

    /* ============================ users as admins============================ */
    Route::get('/user/all', 'AdminController@showUsers')->middleware('permission:User-Edit|User-Delete');
    Route::get('/users/get_datatable', 'AdminController@getDatatableUser'); // get all users with datatable

    Route::get('/user/create', 'AdminController@createUser')->middleware('permission:User-Add');
    Route::post('/user/create', 'AdminController@storeNewUser')->middleware('permission:User-Add');
    Route::get('/user/{id}/edit', 'AdminController@editUser')->middleware('permission:User-Edit'); // edit user
    Route::post('/user/{id}/edit', 'AdminController@updateUser')->middleware('permission:User-Edit');
    ; // update user
    Route::get('/user/{id}/delete', 'AdminController@deleteUser')->middleware('permission:User-Delete'); // delete user


    Route::get('/user/profile/{id}/edit', 'AdminController@editProfile'); // edit profile
    Route::post('/user/{id}/update_password', 'AdminController@update_password')->middleware('permission:User-Edit|User-Delete'); // admin update password to user

    /* ============================ admin controll in Courses & Trainers  ============================ */
    Route::get('/trainer/all', 'Hr\Course\TrainerController@allTrainers')->middleware('permission:Trainer-Edit|Trainer-Delete'); // get all trainers
    Route::get('/trainer/report', 'Hr\Course\TrainerController@trainerReports')->middleware('permission:Trainer-Edit|Trainer-Delete'); // get report for all trainers
    Route::post('/trainer/export', 'Hr\Course\TrainerController@exportTrainer')->middleware('permission:Trainer-Edit|Trainer-Delete'); // get report for all trainers
    Route::get('/trainer/all/get_datatable', 'Hr\Course\TrainerController@getDatatableTrainers')->middleware('permission:Trainer-Edit|Trainer-Delete'); // get datatable
    Route::get('/trainer/pending', 'Hr\Course\TrainerController@pendingTrainers')->middleware('permission:Trainer-Edit|Trainer-Delete');
    Route::get('/trainer/{id}/change', 'Hr\Course\TrainerController@changeStatus')->middleware('permission:Trainer-Edit|Trainer-Delete')->name('trainer_activate');
    Route::get('/trainer/all/pendingTrainersDatatable', 'Hr\Course\TrainerController@pendingTrainersDatatable')->middleware('permission:Trainer-Edit|Trainer-Delete'); // get datatable

    Route::get('/trainer/create', 'Hr\Course\TrainerController@addTrainer')->middleware('permission:Trainer-Add'); // show form to add traineer
    Route::post('/trainer/create', 'Hr\Course\TrainerController@store')->middleware('permission:Trainer-Add'); // store new trainer

    Route::get('/trainer/{id}/edit', 'Hr\Course\TrainerController@editTrainer')->middleware('permission:Trainer-Edit'); // show form to edit trainer
    Route::post('/trainer/{id}/edit', 'Hr\Course\TrainerController@updateTrainer')->middleware('permission:Trainer-Edit'); // store data to trainer

    Route::get('/trainer/{id}/delete', 'Hr\Course\TrainerController@deleteTrainer')->middleware('permission:Trainer-Delete');

    /* =============== User Courses =========== */

    Route::get('/myCourses','Hr\Course\CourseController@myCourses')->middleware('permission:Course-Edit|Course-Delete');

    /* =============== Courses =========== */
    Route::get('/course/all', 'Hr\Course\CourseController@allCourses')->middleware('permission:Course-Edit|Course-Delete')->name('course.index'); //get all courses
    Route::get('/course/all/get_datatable', 'Hr\Course\CourseController@getDatatableCourses')->middleware('permission:Course-Edit|Course-Delete');
    Route::get('/myCourses/get_user_datatable', 'Hr\Course\CourseController@getUserDataTable')->middleware('permission:Course-Edit|Course-Delete');
    Route::get('/myCourses/get_user_pendingCourse_datatable', 'Hr\Course\CourseController@getUserDataTable')->middleware('permission:Course-Edit|Course-Delete');

    Route::get('/course/create', 'Hr\Course\CourseController@addCourse')->middleware('permission:Course-Add'); // show form to add course
    Route::post('/course/create', 'Hr\Course\CourseController@store')->middleware('permission:Course-Add'); // store new course

    Route::get('/course/{id}/edit', 'Hr\Course\CourseController@editCourse')->middleware('permission:Course-Edit'); // show form to edit course
    Route::post('/course/{id}/edit', 'Hr\Course\CourseController@updateCourse')->middleware('permission:Course-Edit'); // update data to course

//    Route::get('/admin/course/{id}/delete', 'Hr\Course\CourseController@deleteCourse')->middleware('permission:Course-Delete'); // show form to edit course
    Route::get('/course/{id}/delete', 'Hr\Course\CourseController@deleteCourse')->middleware('permission:Course-Delete'); // show form to edit course
    Route::get('/course/getimage', 'Hr\Course\CourseController@downloadAttachments')->name('course_getAttachment')->middleware('permission:Course-Edit'); // delete data to category
    Route::get('/course/destroyattach', 'Hr\Course\CourseController@deleteMediaAttach')->name('course.attach.destroy')->middleware('permission:Course-Delete'); // delete income / expense

    Route::get('/course/{id}/video', 'Hr\Course\CourseController@addCourseVideo')->middleware('permission:Course-Video'); // add videos to course
    Route::post('/course/{id}/video', 'Hr\Course\CourseController@storeCourseVideo')->middleware('permission:Course-Video'); // add videos to course
    Route::get('/course/video/{id}/edit', 'Hr\Course\CourseController@editVideo')->middleware('permission:Course-Video'); //edit videos to course
    Route::post('/course/video/upload/{id}', 'Hr\Course\CourseController@dropzoneUploadVideo'); //upload videos to course
    Route::post('/course/video/delete', 'Hr\Course\CourseController@dropzoneDeleteVideo'); //upload videos to course


    Route::post('/course/video/{id}/update', 'Hr\Course\CourseController@updateVideo')->middleware('permission:Course-Video'); //edit videos to course
    Route::get('/admin/course/video/{id}/delete', 'Hr\Course\CourseController@deleteVideo')->middleware('permission:Course-Video'); //delete videos to course
    Route::delete('/course/video/delete/{id}', 'Hr\Course\CourseController@deleteVideo')->middleware('permission:Course-Video'); //delete videos to course

    Route::get('/course/videos/{course_id}', 'Hr\Course\CourseController@datatableVideos')->middleware('permission:Course-Video');
    Route::get('/course/media_tag/delete', 'Hr\Course\CourseController@deleteTag')->middleware('permission:Course-Video')->name('tag.destroy');

    /* =============== Course Exam =========== */

    //Route::get('get_choices/', 'Hr\Course\CourseExamController@getChoices')->middleware('permission:Course-Exam-Edit|Course-Exam-Delete')->name("get_choices");
    Route::get('get_choices/{id}', 'Hr\Course\CourseExamController@getChoices')->middleware('permission:Course-Exam-Edit|Course-Exam-Delete')->name("get_choices");
    Route::post('del_choices', 'Hr\Course\CourseExamController@delChoices')->middleware('permission:Course-Exam-Edit|Course-Exam-Delete')->name("del_choices");
    Route::post('add_choice', 'Hr\Course\CourseExamController@addChoice')->middleware('permission:Course-Exam-Edit|Course-Exam-Delete')->name("add_choice");
    Route::get('/course_exam/all', 'Hr\Course\CourseExamController@index')->middleware('permission:Course-Exam-Edit|Course-Exam-Delete');
    Route::get('/course_exam/all/get_datatable', 'Hr\Course\CourseExamController@getDatatableExams')->middleware('permission:Course-Exam-Edit|Course-Exam-Delete');
    Route::get('/course/{id}/course_exam/create', 'Hr\Course\CourseExamController@create')->middleware('permission:Course-Exam-Add');
    Route::post('/course/{id}/course_exam/store', 'Hr\Course\CourseExamController@store')->middleware('permission:Course-Exam-Add');
    Route::get('/course/course_exam/{id}/edit', 'Hr\Course\CourseExamController@edit')->middleware('permission:Course-Exam-Edit');
    Route::post('/course/course_exam/{id}/update', 'Hr\Course\CourseExamController@update')->middleware('permission:Course-Exam-Edit');
    Route::get('course/course_exam/{id}/delete', 'Hr\Course\CourseExamController@delete')->middleware('permission:Course-Exam-Delete'); //delete videos to course
    Route::post('/choice_change','Hr\Course\CourseExamController@choice_change')->middleware('permission:Course-Exam-Add');



    /* =============== Course Category =========== */
    Route::get('/course/category/all', 'Hr\Course\Co_categoryController@allCategory')->middleware('permission:CourseCategory-Edit|CourseCategory-Delete'); //get all courses
    Route::get('/course/category/all/get_datatable', 'Hr\Course\Co_categoryController@getDatatableCourseCategory')->middleware('permission:CourseCategory-Edit|CourseCategory-Delete');

    Route::post('/course/category/create', 'Hr\Course\Co_categoryController@storeCategory')->middleware('permission:CourseCategory-Add'); // store new category

    Route::post('/course/category/{id}/edit', 'Hr\Course\Co_categoryController@updateCategory')->middleware('permission:CourseCategory-Edit'); // update data to category

    Route::get('course/category/del', 'Hr\Course\Co_categoryController@deleteCategory')->middleware('permission:CourseCategory-Delete'); // delete data to category
    Route::get('/course/category/list', 'Hr\Course\Co_categoryController@list')->middleware('permission:CourseCategory-Add');

    /* ================================ Applicants ===================================== */
    Route::get('/course/applicant/all', 'Hr\Course\ApplicantController@allApplicant')->middleware('permission:Applicant-Edit|Applican-Delete'); // show all applicant
    Route::get('/course/applicant/ajax_search', 'Hr\Course\ApplicantController@getDatatableApplicantByCourseName')->middleware('permission:Applicant-Edit|Applican-Delete'); // show all applicant by course name
    Route::get('/course/applicant/get_datatable', 'Hr\Course\ApplicantController@getDatatableApplicant'); // show datatable for all applicant

    Route::get('/course/applicant/create', 'Hr\Course\ApplicantController@createApplicant')->middleware('permission:Applicant-Add'); // show view to add applicant
    //Route::post('/admin/course/applicant/create','Hr\Course\ApplicantController@storeApplicant')->middleware('permission:Applicant-Add'); // store data to applicant

    Route::get('/course/applicant/{id}/edit', 'Hr\Course\ApplicantController@showApplicant')->middleware('permission:Applicant-Edit'); // show view to add applicant
    Route::post('/course/applicant/{id}/edit', 'Hr\Course\ApplicantController@updateApplicant')->middleware('permission:Applicant-Edit'); // store data to applicant

    Route::get('/course/applicant/{id}/delete', 'Hr\Course\ApplicantController@deleteApplicant')->middleware('permission:Applicant-Delete'); // delete applicant

    /* Show */
//    Route::get('/courses/applicant/info', 'Hr\Course\ApplicantController@getApplicantInfo')->name('info_applicant');

    /* ================================ Applicant Course Pendings ===================================== */
    Route::get('/course/applicant/pending/all', 'Hr\Course\Applicant_course_pendingController@all')->middleware('permission:ApplicantPending-Add|ApplicantPending-Delete'); // show all applicant course pendings
    Route::get('/course/applicant/pending/datatable', 'Hr\Course\Applicant_course_pendingController@getDatatableCoursesPending')->middleware('permission:ApplicantPending-Add|ApplicantPending-Delete'); // get datatable applicant courses pendings
    Route::get('/course/applicant/pending/{id}/edit', 'Hr\Course\Applicant_course_pendingController@edit')->middleware('permission:ApplicantPending-Add|ApplicantPending-Delete'); // show data applicant courses pendings
    Route::post('/course/applicant/pending/{id}/approve', 'Hr\Course\Applicant_course_pendingController@approvePayment')->middleware('permission:ApplicantPending-Add'); // approve applicant courses pendings
    Route::get('/course/applicant/pending/{id}/delete', 'Hr\Course\Applicant_course_pendingController@delete')->middleware('permission:ApplicantPending-Delete'); // delete applicant pendings
    /* =============== gallery =========== */

    Route::get('/gallery/create', 'GalleryController@create')->middleware('permission:Gallery-Add'); //add gallery
    Route::post('/gallery/create', 'GalleryController@store')->middleware('permission:Gallery-Add'); //store gallery

    Route::get('/gallery/{id}/edit', 'GalleryController@edit')->middleware('permission:Gallery-Edit'); //edit gallery
    Route::get('/gallery/getimage', 'GalleryController@downloadAttachments')->middleware('permission:Gallery-Add')->name('gallery_getAttachment');
    Route::post('/gallery/{id}/edit', 'GalleryController@update')->middleware('permission:Gallery-Edit'); //update gallery

    Route::get('/gallery/{id}/delete', 'GalleryController@delete')->middleware('permission:Gallery-Delete'); //delete gallery

    Route::get('/gallery/all', 'GalleryController@all')->middleware('permission:Gallery-Edit|Gallery-Delete');
    Route::get('/gallery/getdatatable', 'GalleryController@getDatatableGallery')->middleware('permission:Gallery-Edit|Gallery-Delete');

    include_once('mo.php');

/* =========================== new routes ====================================================================== */

    Route::get('/courseRequest','Admin\CourseRequestController@index')->middleware('permission:CourseRequest-Controll');
    Route::post('/courseRequest/{id}/update','Admin\CourseRequestController@update')->middleware('permission:CourseRequest-Controll');
    Route::delete('/courseRequest/{id}/delete','Admin\CourseRequestController@destroy')->middleware('permission:CourseRequest-Controll');


    Route::get('/currency','Admin\CurrencyController@index')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add');
    Route::post('/currency/store','Admin\CurrencyController@store')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add');
    Route::get('/currency/show','Admin\CurrencyController@show')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add')->name('currencyShow');
    Route::post('currency/{id}/update','Admin\CurrencyController@update')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add');
    Route::delete('/currency/{id}/delete','Admin\CurrencyController@destroy')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add');

    /* ------------------------ countries --------------------------  */
    Route::get('country/all' , 'CountriesController@index')->middleware('permission:Country-Add|Country-Edit|Country-Delete');
    Route::get('country/datatable' , 'CountriesController@get_datatable')->middleware('permission:Country-Add|Country-Edit|Country-Delete');
    Route::get('country/create' , 'CountriesController@create')->middleware('permission:Country-Add');
    Route::post('country/store' , 'CountriesController@store')->middleware('permission:Country-Add');
    Route::get('country/{id}/edit' , 'CountriesController@edit')->middleware('permission:Country-Edit');
    Route::post('country/{id}/update' , 'CountriesController@update')->middleware('permission:Country-Edit');
    Route::delete('country/{id}/delete' , 'CountriesController@destroy')->middleware('permission:Country-Delete')->name('country.destroy');
    Route::get('country/list' , 'CountriesController@list');
    Route::get('currency/list' , 'Admin\CurrencyController@list');

    /* ------------------------ cities --------------------------  */
    Route::get('city/get_datatable' , 'CitiesController@get_datatable')->middleware('permission:City-Add|City-Edit|City-Delete');
    Route::get('city/all' , 'CitiesController@index')->middleware('permission:City-Add|City-Edit|City-Delete');
    Route::post('city/store' , 'CitiesController@store')->middleware('permission:City-Add|City-Edit|City-Delete');
    Route::post('city/update' , 'CitiesController@update')->middleware('permission:City-Add|City-Edit|City-Delete');
    Route::get('city/delete' , 'CitiesController@destroy')->middleware('permission:City-Add|City-Edit|City-Delete')->name('city.destroy');

    /* ------------------------ education level --------------------------  */
    Route::group(['namespace' => 'Hr\Course'] , function(){

        Route::get('education_level/get_datatable' , 'EducationLevelController@get_datatable')->middleware('permission:EducationLevel-Add|EducationLevel-Edit|EducationLevel-Delete');
        Route::get('education_level/all' , 'EducationLevelController@index')->middleware('permission:EducationLevel-Add|EducationLevel-Edit|EducationLevel-Delete');
        Route::post('education_level/store' , 'EducationLevelController@store')->middleware('permission:EducationLevel-Add');
        Route::post('education_level/update' , 'EducationLevelController@update')->middleware('permission:EducationLevel-Edit');
        Route::get('education_level/delete' , 'EducationLevelController@destroy')->middleware('permission:EducationLevel-Delete');

    });

    /*   ------------------- Articles --------------------- */
    Route::group(['namespace' => 'Admin\Article'], function() {
        Route::get('article/all', 'ArticleController@index')->middleware('permission:Article-Add|Article-Edit|Article-Delete');
        Route::get('article/datatable', 'ArticleController@datatableArticles')->middleware('permission:Article-Add|Article-Edit|Article-Delete');
        Route::get('article/create', 'ArticleController@create')->middleware('permission:Article-Add');
        Route::post('article/store', 'ArticleController@store')->middleware('permission:Article-Add');
        Route::get('article/{id}/edit', 'ArticleController@edit')->middleware('permission:Article-Edit');
        Route::post('article/{id}/update', 'ArticleController@update')->middleware('permission:Article-Edit');
        Route::delete('article/{id}/delete', 'ArticleController@delete')->middleware('permission:Article-Delete')->name('article.destroy');
        /* --------- Artcl categories ------- */
        Route::get('artcle_category/all', 'Artcl_categoriesController@index')->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
        Route::get('artcle_category/datatable', 'Artcl_categoriesController@getDatatableArticleCats')->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
        Route::get('artcle_category/create', 'Artcl_categoriesController@create')->middleware('permission:ArticleCategory-Add');
        Route::post('artcle_category/store', 'Artcl_categoriesController@store')->middleware('permission:ArticleCategory-Add');
        Route::get('artcle_category/{id}/edit', 'Artcl_categoriesController@edit')->middleware('permission:ArticleCategory-Edit');
        Route::post('artcle_category/{id}/update', 'Artcl_categoriesController@update')->middleware('permission:ArticleCategory-Edit');
        Route::delete('artcle_category/{id}/delete', 'Artcl_categoriesController@delete')->middleware('permission:ArticleCategory-Delete')->name('artcl_categories.destroy');

        Route::get('artcle_category/list' , 'Artcl_categoriesController@list')->middleware('permission:ArticleCategory-Add|ArticleCategory-Edit|ArticleCategory-Delete');
    });

    /* =============== news letters =========== */

    Route::get('/newsletters/all', 'Admin\NewsLettersController@all')->middleware('permission:NewsLetters-Edit|NewsLetters-Delete'); //get all news letters
    Route::get('/newsletters/get_datatable', 'Admin\NewsLettersController@getDatatableNewsLetters')->middleware('permission:NewsLetters-Edit|NewsLetters-Delete');

    Route::post('/newsletters/add', 'Admin\NewsLettersController@addSubscriber')->middleware('permission:NewsLetters-Add'); //add subscriber to news letters
    Route::post('/newsletters/{id}/edit', 'Admin\NewsLettersController@editSubscriber')->middleware('permission:NewsLetters-Edit'); //edit subscriber to news letters

    Route::get('/newsletters/delete', 'Admin\NewsLettersController@delete')->middleware('permission:NewsLetters-Delete'); //delete subscriber news letters

    Route::get('/newsletters/export', 'Admin\NewsLettersController@expotNewsLettersExcel')->middleware('permission:NewsLetters-Edit|NewsLetters-Delete'); //export all news letters as excel

    /* ------------------------ site settings --------------------------  */

    Route::group(['namespace' => 'Admin'], function (){

        Route::get('settings' , 'SettingsController@get_settings')->middleware('permission:Settings-Add|Settings-Edit|Settings-Delete');
        Route::get('settings/slider/datatable' , 'SettingsController@getDatatableSlider')->middleware('permission:Settings-Add|Settings-Edit|Settings-Delete'); //return datatable
        Route::post('settings/store' , 'SettingsController@store_settings')->middleware('permission:Settings-Add');
        Route::post('settings/slider/store' , 'SettingsController@store_slider')->middleware('permission:Settings-Add');
        Route::get('settings/slider/{id}/edit' , 'SettingsController@edit_slider')->middleware('permission:Settings-Edit');
        Route::post('settings/slider/{id}/update' , 'SettingsController@update_slider')->middleware('permission:Settings-Edit');
        Route::delete('settings/slider/{id}/delete' , 'SettingsController@slider_destroy')->middleware('permission:Settings-Delete')->name('slider.destroy');
        /* =================== price setting ============================== */
        Route::get('price_setting' , 'SettingsController@price_setting')->middleware('permission:Settings-Add|Settings-Edit|Settings-Delete');
        Route::post('price_setting' , 'SettingsController@price_setting_store')->middleware('permission:Settings-Add|Settings-Edit|Settings-Delete');

        /* ============== Course Comments  ============== */
         Route::get('course_comment/all', 'CourseCommentController@index')->middleware('permission:CourseComments-Show|CourseComments-Delete');
         Route::get('course_comment/datatable', 'CourseCommentController@datatableCourseComment')->middleware('permission:CourseComments-Show|CourseComments-Delete');
        Route::get('course_comment/{id}/show', 'CourseCommentController@show')->middleware('permission:CourseComments-Show|CourseComments-Delete');
        Route::get('course_comment/{id}/approve', 'CourseCommentController@approve')->middleware('permission:CourseComments-Show|CourseComments-Delete');
        Route::get('course_comment/{id}/delete', 'CourseCommentController@delete')->middleware('permission:CourseComments-Show|CourseComments-Delete');

        /* ============== Contacts  ============== */
        Route::get('/contact/all', 'ContactController@all')->middleware('permission:Contact-Show|Contact-Delete');
        Route::get('/contact/all/getDatatable', 'ContactController@getDatatableContact')->middleware('permission:Contact-Show|Contact-Delete'); //get database contact
        Route::get('/contact/{id}/show', 'ContactController@show')->middleware('permission:Contact-Show');
        Route::get('/contact/{id}/delete', 'ContactController@delete')->middleware('permission:Contact-Delete');

          Route::get('/convert','CurrencyConverterController@index')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add');
//    Route::post('/currency/store','Admin\CurrencyController@store')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add');
//    Route::get('/currency/show','Admin\CurrencyController@show')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add')->name('currencyShow');
//    Route::POST('/currency/{id}/update','Admin\CurrencyController@update')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add');
//    Route::delete('/currency/{id}/delete','Admin\CurrencyController@destroy')->middleware('permission:Currency-Edit|Currency-Delete|Currency-Add');


    });

    Route::group(['namespace' => 'Admin\Rating'] , function(){
        Route::get('rating/datatable' , 'RatingController@datatableRating')->middleware('permission:Rating-Show|Rating-Delete');
        Route::get('rating/all' , 'RatingController@allRating')->middleware('permission:Rating-Show|Rating-Delete');
        Route::get('rating/{id}/show' , 'RatingController@showRate')->middleware('permission:Rating-Show|Rating-Delete');
        Route::get('rating/{rate_id}/delete/{user_id}' , 'RatingController@destroy')->middleware('permission:Rating-Delete')->name('rate.destroy');
        Route::get('rating/approve/{rate_id}/{user_id}' , 'RatingController@approveRate')->middleware('permission:Rating-Show|Rating-Delete');
    });








});

Route::post('/admin/password/reset', 'AdminResetPassword@resetdata');

Route::get('/admin/password/update', 'AdminResetPassword@updatePasswordForm');
Route::post('/admin/password/update', 'AdminResetPassword@updateData');

