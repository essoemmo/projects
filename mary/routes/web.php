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


//Route::group(['middleware' => 'mentance'], function () {
//    Route::get('/', function () {
//        return view('welcome');
//    })->name('web');
//});


Route::get('/config', function()
{
    \Artisan::call('config:cache');
    echo 'dump-autoload complete';
});


Route::get('/', 'web\HomeController@home')->name('home');
Route::get('languages', 'web\HomeController@getLangs')->name('web.languages');
Route::get('change_language', 'web\HomeController@changeLang');

/*Register controller*/
Route::get('get/country','Auth\RegisterController@get_Country')->name('get-Country');
Route::get('get/city','Auth\RegisterController@get_City')->name('get_City');
Route::get('/register' , 'Auth\RegisterController@showRegistrationForm');
Route::post('store/member','Auth\RegisterController@storemember')->name('store-member');


Route::get('/login' , 'Auth\LoginController@showLoginForm');
Route::post('/login' , 'Auth\LoginController@login');

Route::get('reset/password','web\HomeController@reset')->name('reset-password');
Route::post('reset/password','web\HomeController@resetpost')->name('rest-password-post');

Route::get('resetPassword/{token}','web\HomeController@resetPassword');
Route::post('resetPassword/{token}','web\HomeController@resetPasswordPost');

Route::get('/user/logout', 'HomeController@logOut');
Route::post('logout','web\HomeController@logout')->name('logout');


/*Stories page*/
Route::get('stories','web\StoriesController@index')->name('get-story');
Route::get('/paginate/fetch','web\StoriesController@fetch')->name('get-data');


                     /*online user*/
Route::get('onlineUser','web\OnlineUserController@index')->name('get-onlineUser');
Route::get('/paginate/fetch/online','web\OnlineUserController@fetch')->name('get-dataonlineUser');
Route::get('onlineUser/country','web\OnlineUserController@onlineUsercountry')->name('get-onlineUser-country');
Route::get('onlineUser/filter','web\OnlineUserController@onlineUserfilter')->name('get-onlineUser-filter');

                    /*online user*/

                       /*latestuser*/
Route::get('LatestUser','web\HomeController@latestUser')->name('get-latestUser');
Route::get('/paginate/fetch/latest','web\HomeController@fetch')->name('get-datalatestUser');
/*latestuser by country*/
Route::get('LatestUser/country','web\HomeController@latestUsercountry')->name('get-latestUser-country');
Route::get('LatestUser/filter','web\HomeController@latestUserfilter')->name('get-latestUser-filter');
                    /*end last user*/

                                /*best user*/
Route::get('bestUser','web\bestUserController@index')->name('get-bestUser');
Route::get('/paginate/fetch/best','web\bestUserController@fetch')->name('get-databestUser');
Route::get('bestUser/country','web\bestUserController@bestUsercountry')->name('get-bestUser-country');
Route::get('bestUser/filter','web\bestUserController@bestUserfilter')->name('get-bestUser-filter');
                                /*best member*/

                            /*active user*/
Route::get('active/user','web\activeUserController@index')->name('get-activeUser');
Route::get('/paginate/fetch/active','web\activeUserController@fetch')->name('get-dataactiveUser');
Route::get('activeUser/country','web\activeUserController@activeUsercountry')->name('get-activeUser-country');
Route::get('activeUser/filter','web\activeUserController@activeUserfilter')->name('get-activeUser-filter');
                            /*active member*/

/*Article page*/
Route::get('article/','web\ArticleController@index')->name('get-article');



/*details-user*/
Route::get('details/user/{id}','web\profileController@index')->name('user-details');

/*search-user*/
Route::get('search/','web\SearchController@search')->name('search');
Route::get('/paginate/fetch/search','web\SearchController@fetch')->name('fetch-search');
Route::get('get/country/search','web\SearchController@getCountry')->name('get-searchCountry');
Route::get('get/statue/user','web\SearchController@getstatueuser')->name('statue-user');

Route::get('/advanced/search/','web\SearchController@advancedsearch')->name('advanced-search');
Route::post('/advanced/search/','web\SearchController@advancedsearchpost')->name('advanced-search-post');


    /*Member of Details*/
Route::group(['middleware' => 'auth'], function () {


    /*profile Route*/
    Route::post('add/heart/','web\profileController@addheart')->name('add-heart');
    Route::post('add/block/','web\profileController@addblock')->name('add-block');
    Route::post('send/message/','web\profileController@sendmessage')->name('send-messageUser');


    Route::get('profile','web\profileController@profile')->name('profile-user');
    Route::get('get/country/profile','web\profileController@get_Country')->name('get-Country-profile');
    Route::get('get/city/profile','web\profileController@get_City')->name('get_City_profile');
    Route::put('update/user/{id}','web\profileController@updateuser')->name('users-update');
    Route::get('profile/{value}','web\profileController@wishlistandBlocked')->name('profile-value');

       /*updatepassword*/
    Route::patch('update/password','web\profileController@updatePassword')->name('update-password');
    Route::patch('update/email','web\profileController@updateEmail')->name('update-email');
    Route::delete('delete/member','web\profileController@deleteMember')->name('delete-member');

    /*newprofile*/

    Route::get('new/profile','web\profileController@newprofile');

    /*massges*/
    Route::get('massege/all', 'web\profileController@Massage')->name('all-massege');
    Route::get('massege/get_datatable', 'web\profileController@getDatatablemessages')->name('get-datatable-massege');
    Route::delete('remove/message', 'web\profileController@remove')->name('remove-massege');

    /*Replay massege*/

    Route::get('replay/message/{id}','web\profileController@replaypage');
    Route::post('replay/message/','web\profileController@replaymass')->name('replay-mass');

        /*my massege*/

    Route::get('my/massege', 'web\profileController@mymassege')->name('all-massege');
    Route::get('my/massege/get_datatable', 'web\profileController@getDatatablemymessages')->name('get-datatable-my-massege');
    /*my massegge*/
    /*like lise*/
    Route::get('like/get_datatable', 'web\profileController@getDatatablelike')->name('get-datatable-like');
    Route::delete('remove/like', 'web\profileController@removelike')->name('remove-like');
                    /*block lise*/
    Route::get('block/get_datatable', 'web\profileController@getDatatableblock')->name('get-datatable-block');
                    /*likeMe*/
    Route::get('likeMe/get_datatable','web\profileController@getDatatablelikeMe');
            /*notifactions*/
    Route::get('notifaction/get_datatable','web\profileController@getDatatablenotifaction');
    Route::delete('notifaction/delete','web\profileController@deletenotify')->name('remove-notify');
    /*contactAdminstator*/
    Route::get('contact/Adminstator','web\profileController@conatctAdmin');
    Route::post('contact/Adminstator','web\profileController@conatctAdminpost')->name('contact-manger');

    /*my fav partener*/
    Route::get('fav/partener','web\profileController@favrouitpartener');
    Route::post('fav/partener/store','web\profileController@favrouitpartenerpost')->name('favourite-post');


    /*new letter*/


});
Route::get('get/subscribe','web\HomeController@newletter')->name('get-subscript');
Route::post('store/subscribe','web\HomeController@newletterstore')->name('store-subscript');
Route::any('/user/notsubscribe','web\HomeController@deleteSubscriber');


//Route::post('send/message/','web\profileController@sendmessage')->name('send-messageUser');

//Route::get('maintance',function (){
//    if (settings()->mantance == '1'){
//        return redirect()->route('web');
//    }
//    return view('maintance');
//})->name('maintance');


