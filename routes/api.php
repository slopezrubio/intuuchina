<?php

use App\Category;
use App\Offer;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Offer as OfferResource;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/courses/{course}', function($course) {
    return new CategoryResource(Category::where('value', $course)->first());
})->where('course', '([a-z]+[_-]?[a-z])*');

Route::get('/offers/{offer}', function($offer) {
    return new OfferResource(Offer::find($offer));
})->where('offer', '[0-9]+');

// Gets a particular course information.
Route::post('course', function(Request $request) {
//    $category = $request->get('category');
//
//    return view('components.c-price-box', [
//        'price_box' => __('component.c-price-box.' . $category->value),
//        'price' => $category->fee->amount,
//    ]);
});
