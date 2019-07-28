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
Route::get('/internship/filter={industry}', 'OffersController@filterBy')->where('industry', '[a-z]+_?[a-z]*');

/* Job Description */
Route::get('/internship/{offer}', 'OffersController@single')->where('offer', '[0-9]+');

/* Aprende Chino */
Route::get('/learn/{course}', function($course = 1) {
    $params = (object) array(
        'title' => "Aprende Chino",
        'currentCourse' => $course,
    );
    return view('pages/learn-chinese', compact('params'));
})->where('course', '[0-9]');

/* Información Cursos Aprende Chino */
Route::get('/learn/course={courseCode}', function($course) {
    $params = (object) array(
        'course' => $course,
        'price' => (object) array(
            'eu' => $course == 1 ? "499" : "18",
            'usd' => $course == 1 ? "470" : "15"
        ),
        'extra_info' => $course == 1 ? "The price above corresponds to the minimum staying of one month. Visa fees are not included." : "A minimum number of 40 hours in order to apply for this course."
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

/* Administrador */
Route::group(['middleware' => 'App\Http\Middleware\Admin'], function(){
    Route::match(['get', 'post'], '/admin/','HomeController@index');

    Route::get('/admin/offers', 'OffersController@admin')->name('admin.offers');
    Route::post('/admin/offers', 'OffersController@store');
    Route::get('/admin/offers/edit/{offer}', 'OffersController@single')->where('offer', '[0-9]+');
});

/* Formulario de contacto del pie de página */
Route::post('/message','MailMessagesController@send')->name('mail');

/* Autenticación */
Auth::routes();

/* Home */
Route::get('/home', 'HomeController@index')->name('home');
