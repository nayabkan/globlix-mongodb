<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TradeController;

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

Route::get('/', [App\Http\Controllers\AdminController::class, 'login'])->name('/');

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get( '/login', [App\Http\Controllers\AdminController::class, 'login'])->name('login');
Route::post('admin-login', [App\Http\Controllers\AdminController::class, 'loginAdmin'])->name('admin-login');

Route::group(['middleware' => ['adminMiddleware']], function(){
    Route::get('admin-dashboard',[App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin-dashboard');
    Route::get('profile',[App\Http\Controllers\AdminController::class, 'profile'])->name('profile');


    Route::resource( '/category', \App\Http\Controllers\CategoryController::class );
    Route::resource( '/brands', \App\Http\Controllers\BrandController::class );
	Route::resource( '/inquary', \App\Http\Controllers\InquaryController::class );
    Route::resource( '/leads', \App\Http\Controllers\LeadController::class );
	Route::get( '/allusers', [App\Http\Controllers\AdminController::class, 'users'])->name('allusers');
    Route::get( '/vendors', [App\Http\Controllers\AdminController::class, 'vendors'])->name('vendors');
    Route::resource( '/countries', \App\Http\Controllers\CountryController::class );
    Route::get( '/filemanager', [App\Http\Controllers\FileManagerController::class, 'index'])->name('filemanager');

    Route::get( '/product-import', [App\Http\Controllers\ProductController::class, 'importView'])->name('product-import');
    Route::post( '/importing', [App\Http\Controllers\ProductController::class, 'importCsv'])->name('importing');

    Route::get( '/bids', [App\Http\Controllers\AdminController::class, 'AuctionBids'])->name('bids');
    
    Route::get( '/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products');
    Route::get( '/addproduct', [App\Http\Controllers\ProductController::class, 'create'])->name('addproduct');
    Route::post( '/storeproduct', [App\Http\Controllers\ProductController::class, 'store'])->name('storeproduct');
    Route::get( '/editproduct/{id}', [App\Http\Controllers\ProductController::class, 'edit'])->name('editproduct');
    Route::post( '/updateproduct/{id}', [App\Http\Controllers\ProductController::class, 'update'])->name('updateproduct');
    Route::post( '/deleteproduct/{id}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('deleteproduct');

    Route::get( '/auctions', [App\Http\Controllers\AuctionController::class, 'index'])->name('auctions');
    Route::get( '/addauction', [App\Http\Controllers\AuctionController::class, 'create'])->name('addauction');
    Route::post( '/storeauction', [App\Http\Controllers\AuctionController::class, 'store'])->name('storeauction');
    Route::get( '/editauction/{id}', [App\Http\Controllers\AuctionController::class, 'edit'])->name('editauction');
    Route::post( '/updateauction/{id}', [App\Http\Controllers\AuctionController::class, 'update'])->name('updateauction');
    Route::post( '/deleteauction', [App\Http\Controllers\AuctionController::class, 'destroy'])->name('deleteauction');

    // Route::resource('/trade', [TradeController::class]);
    Route::resource( '/trades', \App\Http\Controllers\TradeController::class );

 
    Route::get('logout',[App\Http\Controllers\AdminController::class, 'logout'])->name('logout');
});
