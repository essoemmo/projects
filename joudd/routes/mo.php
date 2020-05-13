<?php
/* ====================================================================================================================================================== */


/* =============================================== Courses ========================================================= */

/* Question */
    /* Show */
    Route::get('/adminpanel/course/question/index_course_question', 'Hr\Course\QuestionController@indexCourseQuestions')->name('index_course_question');
    Route::get('/adminpanel/course/question/index_trainer_question', 'Hr\Course\QuestionController@indexTrainerQuestions')->name('index_trainer_question');
    Route::get('/adminpanel/course/question/getdata_course', 'Hr\Course\QuestionController@getDataCourse')->name('getData_course_question');
    Route::get('/adminpanel/course/question/getdata_trainer', 'Hr\Course\QuestionController@getDataTrainer')->name('getData_trainer_question');
    Route::post('/adminpanel/course/question/create', 'Hr\Course\QuestionController@store')->name('create_question');
    /* Edit */
    Route::post('/adminpanel/course/question/update', 'Hr\Course\QuestionController@update')->name('update_question');

    /* Destory */
    Route::get('/adminpanel/course/question/delete', 'Hr\Course\QuestionController@destroy');
/* ====================================================================*/

/* DiscountCodes */

/* Show */
Route::get('/adminpanel/courses/discount_codes/index_discount_codes', 'Hr\Course\DiscountCodeController@index')->name('index_discount_codes');
Route::get('/adminpanel/courses/discount_codes/getdata_discount_codes', 'Hr\Course\DiscountCodeController@getDataDisCodes')->name('getData_discount_codes');
Route::post('/adminpanel/courses/discount_codes/create', 'Hr\Course\DiscountCodeController@store')->name('create_discount_code');
/* Edit */
Route::post('/adminpanel/courses/discount_codes/update', 'Hr\Course\DiscountCodeController@update')->name('update_discount_code');

/* Destory */
Route::get('/adminpanel/courses/discount_codes/delete', 'Hr\Course\DiscountCodeController@destroy');
/* ====================================================================*/

/* Applican */

/* Show */
//Route::get('/adminpanel/courses/applicant/info', 'Hr\Course\ApplicantController@getApplicantInfo')->name('info_applicant');

/* ====================================================================*/

/* Applicant Course */

/* Show */
Route::get('/adminpanel/courses/applicant/index', 'Hr\Course\ApplicantCourseController@index')->name('index_applicant');
Route::get('/adminpanel/courses/applicant/get_course', 'Hr\Course\ApplicantCourseController@getCourse')->name('get_course');
Route::get('/adminpanel/courses/applicant/get_discount_code', 'Hr\Course\ApplicantCourseController@getDiscountCode')->name('get_discount_code');
Route::post('/adminpanel/courses/applicant/create', 'Hr\Course\ApplicantCourseController@store')->name('create_applicant');

/* ====================================================================*/


/* Applicant Result */

/* Show */
Route::get('/adminpanel/courses/applicants/applicant_result/index', 'Hr\Course\ApplicantResultController@index')->name('index_applicant_result');
Route::post('/adminpanel/courses/applicants/applicant_result/create', 'Hr\Course\ApplicantResultController@store')->name('store_applicant_result');
Route::get('/adminpanel/courses/applicants/applicant_result/getApplicants', 'Hr\Course\ApplicantResultController@getApplicants')->name('get_applicants_');
///* ====================================================================*/
//
///* About Us */
//
///* Show */
//Route::get('/adminpanel/aboutus/edit_aboutus', 'AboutUs\AboutUsController@edit')->name('edit_aboutus');
//Route::get('/adminpanel/aboutus/show_aboutus', 'AboutUs\AboutUsController@show')->name('show_aboutus');
///* Save */
//Route::get('/adminpanel/aboutus/save_aboutus', 'AboutUs\AboutUsController@save_aboutus')->name('save_aboutus');
///* ====================================================================*/
//
Route::get('/adminpanel/CourseController/CourseController', 'Hr\Course\CourseController@downloadAttachments');

?>
