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

/**
 * |--------------------------------------------------------------------------
 * | Index
 * |--------------------------------------------------------------------------
 */
Route::get('/', function () {
    return view('pages/home');
});
Route::get('learn', 'IndexController@learn');
Route::get('university', 'IndexController@university');
Route::post('/application-form','IndexController@applicationForm')->name('application.form');
Route::get('/why', function() {
    return view('pages/why-intuuchina');
})->name('whyus');


/**
 * |--------------------------------------------------------------------------
 * | Internship
 * |--------------------------------------------------------------------------
 */
Route::prefix('internship')->group(function() {
    Route::get('/', 'OffersController@index')->name('internship');
    Route::get('/{industry}', 'OffersController@filterBy')->where('industry', '[a-z]+_?[a-z]*');
    Route::get('{offer}',  'OffersController@single')->where('offer', '[0-9]+')->name('single-offer');
});

/* Login */
Route::get('/login', function() {
    return view('pages/login');
});


/**
 * |--------------------------------------------------------------------------
 * | Administrator
 * |--------------------------------------------------------------------------
 */
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

/**
 * |--------------------------------------------------------------------------
 * | Validations
 * |--------------------------------------------------------------------------
 */
Route::prefix('validate')->group(function() {
    Route::post('payment-details', 'CheckoutsController@validatePaymentDetails');
    Route::post('{field}', 'ValidationsController@validateField');
});

/**
 * |--------------------------------------------------------------------------
 * | Footer
 * |--------------------------------------------------------------------------
 */
Route::post('/message','MailMessagesController@send')->name('mail');

/**
 * |--------------------------------------------------------------------------
 * | Email Verification
 * |--------------------------------------------------------------------------
 */
Route::get('user/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('user/verify/{id}/{payment?}', 'Auth\VerificationController@verify')->name('verification.email');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

/**
 * |--------------------------------------------------------------------------
 * | Authentication
 * |--------------------------------------------------------------------------
 */
Auth::routes();

/**
 * |--------------------------------------------------------------------------
 * | User
 * |--------------------------------------------------------------------------
 */
Route::group(['middleware' => 'auth'], function() {
    Route::group(['prefix' => 'payments'], function() {
        Route::post('study', 'CheckoutsController@chineseCoursePayment')->name('payments.study');
        Route::post('university', 'CheckoutsController@applicationFeeForm')->name('payments.university');
        Route::post('internship', 'CheckoutsController@applicationFeeForm')->name('payments.internship');
        Route::post('inter-relocat', 'CheckoutsController@applicationFeeForm')->name('payments.inter_relocat');
    });
    Route::get('welcome', 'WelcomeController@index')->name('welcome');
    Route::get('home', 'HomeController@index')->name('home');
    Route::post('confirm', 'UsersController@confirm')->name('confirm');
    Route::post('payment-method', 'CheckoutsController@newPaymentIntent')->name('payment_method');
    Route::get('{user}/profile', 'UsersController@single')->where('user', '[0-9]+')->name('edit_user');
    Route::post('{user}/program', 'UsersControllers@changeProgram')->name('change.program');
    Route::post('{user}/update/{program}', 'UsersController@updateProgram')->name('update.program');
});

Route::get('payment-successful', 'Auth\CheckoutsController@test');
/* Stripe WebHooks */





