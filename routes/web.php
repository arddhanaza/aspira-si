<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['withoutMiddleware' => 'loggedIn'], function () {
    Route::get('/', 'LoginController@index');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::get('/logout', 'LoginController@logout')->name('logout');

    Route::get('/lupapassword', 'LoginController@lupaPassword')->name('lupa_password');
    Route::post('/lupapassword/validate', 'LoginController@validateLupaPassword')->name('validate_lupa_password');
    Route::get('/lupapassword/validate/{id}/edit', 'LoginController@editPassword')->name('edit_lupa_password');
    Route::put('/lupapassword/validate/{id}/edit/save', 'LoginController@saveEditPassword')->name('save_edit_lupa_password');
});

Route::group(['middleware' => 'loggedIn'], function () {
    //feed
    Route::get('/feed', 'AspirationController@index')->name('feed');
    Route::get('/feed-sorted', 'AspirationController@feedPopular')->name('feedPopular');
    //aspiration
    Route::post('/PostAspiration', 'AspirationController@store');
    Route::get('/aspiration/{id}', 'AspirationController@show')->name('detailAspiration');
    Route::put('/aspiration/update/{id}','AspirationController@update')->name('update');
    //reply
    Route::post('/reply', 'ReplyController@store')->name('comment');
    Route::get('/reply/delete/{id_comment}','ReplyController@delete')->name('deleteReply');
    //vote
    Route::get('/feed/likes/{id}/{id_aspirasi}', 'VoteController@postUpVote')->name('upvote');
    Route::get('/feed/dislikes/{id}/{id_aspirasi}', 'VoteController@postDownVote')->name('downvote');
    //profile
    Route::get('/profile/{user}', 'UserController@index')->name('profile');
    Route::get('/profile/{user}/edit', 'UserController@function_name')->name('editprofil');
    Route::get('profile/{user}/edit', 'UserController@edit')->name('edit_password');
    Route::put('profile/{user}/edit', 'UserController@update')->name('save_edit_password');
    //announcement
    Route::get('/announcement', 'AnnouncementController@getAllAnnouncement')->name('all_announcement');
    //notifikasi
    Route::get('/notifikasi/delete/','NotifikasiController@destroy')->name('delete_notifikasi');
    //bpm
    Route::group(['middleware' => 'loggedInAsBpm'], function () {
        Route::get('/bpm/allaspiration', 'AspirationController@getAllAspiration')->name('bpmAllAspiration');
        Route::put('/aspiration/{id}', 'AspirationController@update')->name('updateApirationStatus');
        Route::get('/bpm/user_management','UserController@getAllData')->name('user_management');
        Route::put('/bpm/user_management/entitas/update/{id}','UserController@updateDataEntitas')->name('updateDataEntitas');
        Route::put('/bpm/user_management/entitas/update_password/{id}','UserController@resetPasswordEntitas')->name('resetPasswordEntitas');
        Route::put('/bpm/user_management/entitas/delete/{id}','UserController@hapusDataEntitas')->name('hapusDataEntitas');
        Route::post('/aspiration/delete/{id}', 'AspirationController@destroy')->name('deleteAspiration');
    });
    //entitas
    Route::group(['middleware' => 'loggedInAsEntitas'], function () {
        Route::get('/entitas/foryou', 'AspirationController@getAspirationForYou')->name('foryou');
        Route::get('/entitas/announcement', 'AnnouncementController@index')->name('announcement');
        Route::get('/announcement/{id}/delete', 'AnnouncementController@destroy')->name('delete_announcement');
        Route::get('/announcement/{id}/edit', 'AnnouncementController@edit')->name('edit_announcement');
        Route::put('/announcement/{id}/edit/save', 'AnnouncementController@update')->name('update_announcement');
        Route::post('/post_announcement', 'AnnouncementController@store')->name('post_announcement');
    });
});

Route::get('forgot-password', function () {
    return view(('/Login.forgot-password'));
});
// Route::get('/', function () {
//     return view('timeline');
// });


// Route::get('/', function () {
//     return view('welcome');
// });

//Route::get('/', 'AuthController@showFormLogin')->name('login');
//Route::get('login', 'AuthController@showFormLogin')->name('login');
//Route::post('login', 'AuthController@login');
//Route::get('register', 'AuthController@showFormRegister')->name('register');
//Route::post('register', 'AuthController@register');
//
//Route::group(['middleware' => 'auth'], function () {
//
// Route::get('home', 'HomeController@index')->name('home');
// Route::get('logout', 'AuthController@logout')->name('logout');
//
//});

Route::get('/testCase', function () {
    echo 'Failed';
});
Route::get('/zhaf', function () {
    return view('coba');
});
