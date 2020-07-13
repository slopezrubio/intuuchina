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
 * | Cron Jobs
 * |--------------------------------------------------------------------------
 */

use Illuminate\Support\Facades\Artisan;

Route::get('/m42Kis2G8Ve224A', function() {
    Artisan::call('users:remind');
    return 'Finished';
});

Route::get('/ih6BMGfMIVilxnt', function() {
    Artisan::call('offers:renew');
    return 'Finished';
});

/**
 * |--------------------------------------------------------------------------
 * | Index
 * |--------------------------------------------------------------------------
 */
Route::get('/', 'IndexController@index');
Route::get('learn', 'IndexController@learn')->name('learn');
Route::get('university', 'IndexController@university');
Route::post('application-form','IndexController@applicationForm')->name('application.form');
Route::post('contact-form','MailMessagesController@contactForm')->name('contact.form');
Route::get('why', 'IndexController@why')->name('why-us');


/**
 * |--------------------------------------------------------------------------
 * | Learn Chinese
 * |--------------------------------------------------------------------------
 */
Route::post('category-info', 'CategoriesController@getInfoBox')->name('category-info');

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

        Route::post('programs', 'FeeTypesController@getPrograms')->where('fee_type', '[a-z]+_?[a-z]*');
        Route::match(['get', 'post'], '/','AdminController@index')->name('admin');
        Route::get('password/change', 'AdminController@showChangePasswordForm')->name('admin.password.change');

        /**
         * ------- Users --------
         */
        Route::get('users', 'AdminController@index')->name('admin.users');
        Route::get('users/edit/{user}', 'UsersController@edit')->name('admin.edit-user');
        Route::get('users/delete/{user}', 'UsersController@destroy')->where('offer', '[0-9]+')->name('admin.delete-user');
        Route::match(['get', 'post'], 'users/upgrade/{user}', 'UsersController@upgrade')->name('admin.upgrade-user');
//        Route::get('users/upgrade/{user}', 'UsersController@upgrade')->name('admin.upgrade-user');
        Route::post('users/edit/{offer}', 'UsersController@update')->where('offer', '[0-9]+')->name('admin.update-user');

        /**
         * ------- Offers -------
         */
        Route::get('offers', 'AdminController@index')->name('admin.offers');
        Route::get('offers/delete/{offer}', 'OffersController@destroy')->where('offer', '[0-9]+')->name('admin.delete-offer');
        Route::get('offers/new', 'OffersController@create')->name('admin.new-offer');
        Route::get('offers/edit/{offer}', 'OffersController@edit')->where('offer', '[0-9]+')->name('admin.edit-offer');
        Route::post('offers/new', 'OffersController@store')->name('admin.new-offer');
        Route::post('offers/edit/{offer}', 'OffersController@update')->where('offer', '[0-9]+')->name('admin.update-offer');
        Route::get('offers/filter={industry}', 'OffersController@filterBy')->where('industry', '[a-z]+_?[a-z]*');

        /**
         * -------  Fees  -------
         */
        Route::get('fees', 'AdminController@index')->name('admin.fees');
        Route::get('fees/delete/{fee}', 'FeesController@destroy')->where('fee', '[0-9]+')->name('admin.delete-fee');
        Route::get('fees/new', 'FeesController@create')->name('admin.new-fee');
        Route::post('fees/new', 'FeesController@store')->name('admin.new-fee');
        Route::get('fees/edit/{fee}', 'FeesController@edit')->where('fee', '[0-9]+')->name('admin.edit-fee');
        Route::post('fees/edit/{fee}', 'FeesController@update')->where('fee', '[0-9]+')->name('admin.update-fee');

        /**
         * ---- Testimonials ----
         */
        Route::get('testimonials', 'AdminController@index')->name('admin.testimonials');
        Route::get('testimonials/delete/{testimonial}', 'TestimonialsController@destroy')->where('testimonial', '[0-9]+')->name('admin.delete-testimonial');
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
Route::group(['middleware' => 'user'], function() {
    Route::group(['prefix' => 'payments'], function() {
        Route::post('study', 'CheckoutsController@processPayment')->name('payments.study');
        Route::post('university', 'CheckoutsController@processPayment')->name('payments.university');
        Route::post('internship', 'CheckoutsController@processPayment')->name('payments.internship');
        Route::post('inter-relocat', 'CheckoutsController@processPayment')->name('payments.inter_relocat');
    });
    Route::get('password/change/{token}', 'UsersController@showChangePasswordForm')->name('password.change');
    Route::get('welcome', 'WelcomeController@index')->name('welcome');
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('status', 'HomeController@status')->name('user.status');
    Route::get('profile', 'HomeController@profile')->name('user.profile');
    Route::get('billings', 'HomeController@billings')->name('user.billings');
    Route::get('paid/{charge}', 'CheckoutsController@showPaymentConfirmation')->name('payment_confirmation');
    Route::post('confirm', 'UsersController@confirm')->name('confirm');
    Route::post('payment-method', 'CheckoutsController@newPaymentIntent')->name('payment_method');
    Route::post('profile/edit/{user}', 'UsersController@update')->where('user', '[0-9]+')->name('user.update-user');
    Route::post('{user}/program', 'UsersController@changeProgram')->name('change.program');
    Route::post('{user}/update/{program}', 'UsersController@updateProgram')->name('update.program');
});

Route::group(['middleware' => 'auth'], function() {
    Route::post('password/update', 'UsersController@changePassword')->name('password.update');
});





