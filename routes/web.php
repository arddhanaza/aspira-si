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
    Route::post('/PostAspiration', 'AspirationController@store');
});

Route::get('/profile',function (){
    return view('/users.profile');
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
