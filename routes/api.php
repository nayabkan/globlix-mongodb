<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\OpenController;
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

    Route::get( 'categories', [App\Http\Controllers\API\OpenController::class, 'category']);
    Route::get( 'allbrands', [App\Http\Controllers\API\OpenController::class, 'brands']);
    Route::get( 'allvendors', [App\Http\Controllers\API\OpenController::class, 'vendors']);

    //Route::get( 'category', [App\Http\Controllers\API\CategoryController::class, 'index']);
    Route::get( 'parentcats', [App\Http\Controllers\API\CategoryController::class, 'parent']);
    Route::post( 'childcats', [App\Http\Controllers\API\CategoryController::class, 'childsbyparent']);
    Route::get( 'inquiry', [App\Http\Controllers\API\InquiryController::class, 'index']);
    Route::get( 'country', [App\Http\Controllers\API\CountryController::class, 'index']);
    Route::get( 'brands', [App\Http\Controllers\API\BrandController::class, 'index']);
    Route::get( 'products', [App\Http\Controllers\API\ProductController::class, 'index']);
    Route::post( 'productdetails', [App\Http\Controllers\API\ProductController::class, 'productDetails']);
    Route::get( 'auctions', [App\Http\Controllers\API\AuctionController::class, 'index']);

    Route::get( 'product-types', [App\Http\Controllers\API\ProductController::class, 'productTypes']);

    Route::get( 'furniture', [App\Http\Controllers\API\ProductController::class, 'productFurniture']);

    Route::get( 'trades', [App\Http\Controllers\API\TradeController::class, 'index']);

    // Vendors middleware routes here
    Route::group(['prefix' => 'vendor','middleware' => ['assign.guard:vendor']],function ()
    {
        Route::post('register', [App\Http\Controllers\VendorController::class, 'register']);
        Route::post('login', [App\Http\Controllers\VendorController::class, 'login']);
        Route::post('/logout', [App\Http\Controllers\VendorController::class, 'logout'])->middleware('jwt.auth');
        Route::post('/refresh', [App\Http\Controllers\VendorController::class, 'refresh'])->middleware('jwt.auth');
        Route::get('/user-profile', [App\Http\Controllers\VendorController::class, 'userProfile'])->middleware('jwt.auth');

        Route::post('/createproduct', [App\Http\Controllers\ProductController::class, 'store'])->middleware('jwt.auth');
        Route::post('/createauction', [App\Http\Controllers\AuctionController::class, 'store'])->middleware('jwt.auth');
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

        Route::post( 'send-bid', [App\Http\Controllers\API\AuctionbidController::class, 'store'])->middleware('jwt.auth');

    });

});

    

    