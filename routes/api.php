<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['api'], 'namespace' => 'Api'], function(){

    Route::get( 'category', [App\Http\Controllers\API\CategoryController::class, 'index']);
    Route::get( 'parentcats', [App\Http\Controllers\API\CategoryController::class, 'parent']);
    Route::get( 'childcats/{id}', [App\Http\Controllers\API\CategoryController::class, 'childsbyparent']);
    Route::get( 'inquiry', [App\Http\Controllers\API\InquiryController::class, 'index']);
    Route::get( 'country', [App\Http\Controllers\API\CountryController::class, 'index']);
    Route::get( 'brands', [App\Http\Controllers\API\BrandController::class, 'index']);
    Route::get( 'products', [App\Http\Controllers\API\ProductController::class, 'index']);

    // Vendors middleware routes here
    Route::group(['prefix' => 'vendor','middleware' => ['assign.guard:vendor']],function ()
    {
        Route::post('register', [App\Http\Controllers\VendorController::class, 'register']);
        Route::post('login', [App\Http\Controllers\VendorController::class, 'login']);
        Route::post('/logout', [App\Http\Controllers\VendorController::class, 'logout'])->middleware('jwt.auth');
        Route::post('/refresh', [App\Http\Controllers\VendorController::class, 'refresh'])->middleware('jwt.auth');
        Route::get('/user-profile', [App\Http\Controllers\VendorController::class, 'userProfile'])->middleware('jwt.auth');
    });


    // Users middleware routes here
    Route::group(['prefix' => 'user','middleware' => ['assign.guard:user']],function ()
    {
        Route::post('register', [App\Http\Controllers\UserController::class, 'register']);
        Route::post('login', [App\Http\Controllers\UserController::class, 'login']);
        Route::post('/logout', [App\Http\Controllers\UserController::class, 'logout'])->middleware('jwt.auth');
        Route::post('/refresh', [App\Http\Controllers\UserController::class, 'refresh'])->middleware('jwt.auth');
        Route::get('/user-profile', [App\Http\Controllers\UserController::class, 'userProfile'])->middleware('jwt.auth');

        Route::post( 'send-inquiry', [App\Http\Controllers\API\InquiryController::class, 'store'])->middleware('jwt.auth');

    });

});

    

    