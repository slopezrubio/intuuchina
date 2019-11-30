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
Route::prefix('internship')->group(function() {
    Route::get('/', 'OffersController@index')->name('offers');
    Route::get('/filter={industry}', 'OffersController@filterBy')->where('industry', '[a-z]+_?[a-z]*');
});

/* Job Description */
Route::get('/internship/{offer}', 'OffersController@single')->where('offer', '[0-9]+')->name('single-offer');

/* Aprende Chino */
Route::get('/learn/{course}', function($course = 1) {
    $params = (object) array(
        'title' => __('learn chinese'),
        'currentCourse' => $course,
    );
    return view('pages/learn-chinese', compact('params'));
})->where('course', '[0-9]');

/* Información Cursos Aprende Chino */
Route::get('/learn/course={courseCode}', function($course) {
    $params = (object) array(
        'course' => $course,
    );

    return view('partials/_price-course-info', compact( 'params'));
})->where('courseCode', '[0-9]+');

/* Universidad */
Route::get('/university', function() {
    return view;
});

/* Why Us */
Route::get('/why', function() {
    return view('pages/why-intuuchina');
});

/* Login */
Route::get('/login', function() {
    return view('pages/login');
});

/* Register with parameters */
Route::post('/register/options','Auth\RegisterController@registerWithOptions')->name('register.options');

/* Administrador */
Route::group([
        'middleware' => 'App\Http\Middleware\Admin', 'prefix' => 'admin'
    ], function(){
    Route::match(['get', 'post'], '/admin/','HomeController@admin');
    Route::get('/offers', 'OffersController@admin')->name('admin.offers');
    Route::post('/offers', 'OffersController@store');
    Route::post('/offers/edit/{offer}', 'OffersController@update')->where('offer', '[0-9]+');
    Route::get('/offers/edit/{offer}', 'OffersController@edit')->where('offer', '[0-9]+');
    Route::get('/offers/delete/{offer}', 'OffersController@destroy')->where('offer', '[0-9]+');
    Route::get('/offers/filter={industry}', 'OffersController@filterBy')->where('industry', '[a-z]+_?[a-z]*');
});

// Validator
Route::prefix('validate')->group(function() {
    Route::post('card-holder-name', 'ValidationsController@validateField');
    Route::post('email-payer', 'ValidationsController@validateField');
    Route::post('phone_number', 'ValidationsController@validateField');
});

/* Formulario de contacto del pie de página */
Route::post('/message','MailMessagesController@send')->name('mail');

/* Autenticación */
Auth::routes();

/* Payment */
Route::post('/{user}/fee-payment', 'CheckoutsController@store')->name('fee_payment');

/* Home */
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/confirm', 'UsersController@confirm')->name('confirm');

