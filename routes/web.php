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
    Route::get('/', 'OffersController@index')->name('internship');
    Route::get('/filter={industry}', 'OffersController@filterBy')->where('industry', '[a-z]+_?[a-z]*');
});

/* Job Description */
Route::get('/internship/{offer}', 'OffersController@single')->where('offer', '[0-9]+')->name('single-offer');

/* Información Cursos Aprende Chino */
Route::get('/learn/course={courseCode}', function($course) {
    $params = (object) array(
        'course' => $course,
    );

    return view('partials/_price-course-info', compact( 'params'));
})->where('courseCode', '[0-9]+');

/* Aprende Chino */
Route::get('/learn/{course}', function($course = 1) {
    $params = (object) array(
        'title' => __('learn chinese'),
        'currentCourse' => $course,
    );
    return view('pages/learn-chinese', compact('params'));
})->where('course', '[0-9]')->name('course');

/* Universidad */
Route::match(['get', 'post'],'/university', function() {
    return view;
})->name('university');

/* Why Us */
Route::get('/why', function() {
    return view('pages/why-intuuchina');
})->name('whyus');

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
        Route::match(['get', 'post'], '/','HomeController@admin')->name('admin');
        Route::get('/offers', 'OffersController@admin')->name('admin.offers');
        Route::post('/offers', 'OffersController@store');
        Route::get('/users', 'AdminController@users')->name('admin.users');
        Route::post('/offers/edit/{offer}', 'OffersController@update')->where('offer', '[0-9]+');
        Route::get('/offers/edit/{offer}', 'OffersController@edit')->where('offer', '[0-9]+')->name('admin.edit-offer');
        Route::get('/offers/delete/{offer}', 'OffersController@destroy')->where('offer', '[0-9]+');
        Route::get('/offers/filter={industry}', 'OffersController@filterBy')->where('industry', '[a-z]+_?[a-z]*');
});

// Validator
Route::prefix('validate')->group(function() {
    Route::post('billing_details', 'CheckoutsController@validateBillingDetails');
    Route::post('{field}', 'ValidationsController@validateField');
});

/* Formulario de contacto del pie de página */
Route::post('/message','MailMessagesController@send')->name('mail');

/* Autenticación */
Auth::routes();

/* User Guideline */
Route::group(['middleware' => 'auth'], function() {
    Route::get('home', 'HomeController@index')->name('home');
    Route::post('confirm', 'UsersController@confirm')->name('confirm');
    Route::post('payment-method', 'CheckoutsController@newPaymentIntent')->name('payment_method');
    Route::get('payment-details', 'CheckoutsController@applicationFeeForm')->name('application_fee_form');
    Route::get('{user}/profile', 'UsersController@single')->where('user', '[0-9]+')->name('edit-user');
});

Route::get('payment-successful', 'CheckoutsController@test');
/* Stripe WebHooks */





