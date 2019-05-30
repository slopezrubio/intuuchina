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

Route::get('/', function () {
    return view('pages/home');
});

Route::get('/admin/offers', 'OffersController@index')->name('offers');

Route::post('/admin/offers', 'OffersController@store');

Route::get('/internship', function() {
    return view('pages/internship');
});

Route::get('/learn', function() {
    return view('pages/learn-chinese');
});

Route::get('/university', function() {
    return view('pages/university');
});

Route::get('/why', function() {
    return view('pages/why-intuuchina');
});

Route::get('/internship', function() {
    return view('pages/about');
});

Route::get('/login', function() {
    return view('pages/login');
});

//Route::group(['middleware' => 'App\Http\Middleware\Admin'], function(){
//    Route::match(['get', 'post'], '');
//});

Route::post('/message','MailMessagesController@send')->name('mail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
