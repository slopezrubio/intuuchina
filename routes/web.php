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

/* Ofertas */
Route::get('/internship', 'OffersController@index')->name('offers');
Route::get('/offers/{offer}', 'OffersController@single')->where('offer', '[0-9]+');

/* Aprende Chino */
Route::get('/learn', function() {
    return view('pages/learn-chinese');
});

/* Universidad */
Route::get('/university', function() {
    return view('pages/university');
});

/* Why Us */
Route::get('/why', function() {
    return view('pages/why-intuuchina');
});

/* Login */
Route::get('/login', function() {
    return view('pages/login');
});

/* Administrador */
Route::group(['middleware' => 'App\Http\Middleware\Admin'], function(){
    Route::match(['get', 'post'], '/admin/','HomeController@index');

    Route::get('/admin/offers', 'OffersController@admin')->name('admin.offers');
    Route::post('/admin/offers', 'OffersController@store');
});

/* Formulario de contacto del pie de página */
Route::post('/message','MailMessagesController@send')->name('mail');

/* Autenticación */
Auth::routes();

/* Home */
Route::get('/home', 'HomeController@index')->name('home');
