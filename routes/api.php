<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/courses/{course}', function($course) {
    return response()
            ->json(__('content.courses.' . $course));
})->where('course', '([a-z]+[_-]?[a-z])*');

// Gets a particular course information.
Route::post('course', function(Request $request) {
    $course = $request->get('course');
    return view('partials/_price-course-info', compact( 'course'));
});
