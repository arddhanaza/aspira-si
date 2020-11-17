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



Route::get('/', 'LoginController@index');
Route::post('/login','LoginController@login')->name('login');
Route::get('/logout','LoginController@logout')->name('logout');

Route::group(['middleware'=>'loggedIn'],function (){
    Route::get('/feed','AspirationController@index')->name('feed');
    Route::get('/feed-sorted','AspirationController@feedPopular')->name('feedPopular');
    Route::post('/PostAspiration', 'AspirationController@store');
    Route::get('/profile/{user}', 'UserController@index')->name('profile');
    Route::get('/feed/likes/{id}/{id_aspirasi}','VoteController@postUpVote')->name('upvote');
    Route::get('/feed/dislikes/{id}/{id_aspirasi}','VoteController@postDownVote')->name('downvote');
    Route::get('/bpm/allaspiration', 'AspirationController@getAllAspiration')->name('bpmAllAspiration');
    Route::put('/aspiration/{id}','AspirationController@update')->name('updateApirationStatus');
    Route::get('/aspiration/{id}','AspirationController@show')->name('detailAspiration');
    Route::post('/reply','ReplyController@store')->name('comment');
    Route::get('/entitas/foryou','AspirationController@getAspirationForYou')->name('foryou');
    Route::get('/profile/{user}/edit','UserController@function_name') ->name('editprofil');
    Route::get('profile/{user}/edit','UserController@edit')->name('edit_password');
    Route::put('profile/{user}/edit','UserController@update')->name('save_edit_password');
    Route::get('/reply/delete/{id_aspirasi}','ReplyController@delete');
});



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

Route::get('/testCase', function (){
    echo 'Failed';
});


Route::get('/zhaf',function (){
    return view('coba');
});
