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
Route::get('/', 'IndexController@index');
Route::get('learn', 'IndexController@learn');
Route::get('university', 'IndexController@university');
Route::post('application-form','IndexController@applicationForm')->name('application.form');
Route::post('contact-form','MailMessagesController@contactForm')->name('contact.form');
Route::get('why', function() {
    return view('pages/why-intuuchina');
})->name('whyus');


/**
 * |--------------------------------------------------------------------------
 * | Internship
 * |--------------------------------------------------------------------------
 */
Route::get('internship/{filter?}', 'OffersController@index')->where('filter', '[a-z]+_?[a-z]*')->name('internship');
Route::get('internship/{offer}',  'OffersController@single')->where('offer', '[0-9]+')->name('single-offer');

/**
 * |--------------------------------------------------------------------------
 * | Login
 * |--------------------------------------------------------------------------
 */
Route::get('/login', function() {
    return view('pages/login');
});


/**
 * |--------------------------------------------------------------------------
 * | Admin
 * |--------------------------------------------------------------------------
 */
Route::group([
        'middleware' => 'App\Http\Middleware\Admin', 'prefix' => 'admin'
    ], function(){
        Route::match(['get', 'post'], '/','AdminController@index')->name('admin');
        Route::get('users', 'AdminController@index')->name('admin.users');
        Route::get('offers', 'AdminController@index')->name('admin.offers');
        Route::get('testimonials', 'AdminController@index')->name('admin.testimonials');
        Route::get('users/delete/{user}', 'UsersController@destroy')->name('admin.delete-user');
        Route::get('offers/delete/{offer}', 'OffersController@destroy')->where('offer', '[0-9]+')->name('admin.delete-offer');
        Route::get('testimonials/delete/{testimonial}', 'TestimonialsController@destroy')->where('testimonial', '[0-9]+')->name('admin.delete-testimonial');
        Route::get('offers/new', 'OffersController@create')->name('admin.new-offer');
        Route::get('users/edit/{user}', 'UsersController@single')->name('admin.edit-user');
        Route::get('offers/edit/{offer}', 'OffersController@edit')->where('offer', '[0-9]+')->name('admin.edit-offer');
        Route::post('users/edit/{offer}', 'UsersController@update')->where('offer', '[0-9]+');
        Route::post('offers/edit/{offer}', 'OffersController@update')->where('offer', '[0-9]+')->name('admin.update-offer');
        Route::post('offers/new', 'OffersController@store')->name('admin.new-offer');
        Route::get('offers/filter={industry}', 'OffersController@filterBy')->where('industry', '[a-z]+_?[a-z]*');
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
        Route::post('study', 'CheckoutsController@processPayment')->name('payments.study');
        Route::post('university', 'CheckoutsController@processPayment')->name('payments.university');
        Route::post('internship', 'CheckoutsController@processPayment')->name('payments.internship');
        Route::post('inter-relocat', 'CheckoutsController@processPayment')->name('payments.inter_relocat');
    });
    Route::get('welcome', 'WelcomeController@index')->name('welcome');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('paid/{charge}', 'CheckoutsController@showPaymentConfirmation')->name('payment_confirmation');
    Route::post('confirm', 'UsersController@confirm')->name('confirm');
    Route::post('payment-method', 'CheckoutsController@newPaymentIntent')->name('payment_method');
    Route::get('{user}/profile', 'UsersController@single')->where('user', '[0-9]+')->name('edit_user');
    Route::post('{user}/program', 'UsersController@changeProgram')->name('change.program');
    Route::post('{user}/update/{program}', 'UsersController@updateProgram')->name('update.program');
});





