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
//Route::get('/learn/{course}', function($selected_course) {
//    return view('partials/_price-course-info', compact( 'selected_course'));
//})->where('course', (function() {
//                        $pattern = '^(';
//
//                        foreach (__('content.courses') as $key => $value) {
//                            $pattern .= $key . '|';
//                        }
//
//                        $pattern = substr_replace($pattern, ')$', -1);
//                        return $pattern;
//                    })()
//    );

Route::get('learn', 'IndexController@learn');

/* Aprende Chino */
//Route::match(['get', 'post'],'/learn', function(Illuminate\Http\Request $request) {
//    $selected_course = $request->get('learn-chinese');
//    $courses = __('content.courses');
//    $slider = [];
//
//    $currentKey = array_key_first($courses);
//
//    while ($currentKey !== $selected_course) {
//        next($courses);
//        $currentKey = key($courses);
//        if ($currentKey === $selected_course) {
//            $slider['previous'] = prev($courses);
//            $slider['current'] = next($courses);
//            $slider['next'] = next($courses);
//        }
//    }
//    return view('pages/learn-chinese', compact('slider'));
//})->name('learn');

/* Universidad */
Route::get('university', 'IndexController@university');

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
    Route::post('payment-details', 'CheckoutsController@validatePaymentDetails');
    Route::post('{field}', 'ValidationsController@validateField');
});

/* Formulario de contacto del pie de página */
Route::post('/message','MailMessagesController@send')->name('mail');

// Email verification
Route::get('user/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('user/verify/{id}/{payment?}', 'Auth\VerificationController@verify')->name('verification.email');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

/* Autenticación */
Auth::routes();

/* User Guideline */
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
    Route::post('{user}/program', 'UsersConrollers@addProgram')->name('update.program');
});

Route::get('payment-successful', 'Auth\CheckoutsController@test');
/* Stripe WebHooks */





