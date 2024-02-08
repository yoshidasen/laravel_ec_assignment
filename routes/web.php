<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BuyController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/user_home', function () {
//     return view('user_home');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('user_home', [ProductController::class, 'index']);

// Route::get('user_home', [HomeController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/login_form', [App\Http\Controllers\HomeController::class, 'index'])->name('login_from');

Route::get('/user/product_detail/{id}', [ProductController::class, 'find']);

Route::get('/user/product_search', [ProductController::class, 'search_get']);
Route::post('/user/product_search', [ProductController::class, 'search']);

Route::get('/user/product_cart_confirm', [ProductController::class, 'ses_put']);
Route::post('/user/product_cart_confirm', [ProductController::class, 'ses_put']);

Route::get('/user/product_cart', [ProductController::class, 'ses_get']);
Route::post('/user/product_cart', [ProductController::class, 'ses_get']);

Route::get('/user/product_cart_delete/{key}', [ProductController::class, 'ses_item_del']);
// Route::post('/user/product_cart_delete/{key}', [ProductController::class, 'ses_item_del']);

Route::get('/user/product_buy_confirm', [BuyController::class, 'buy_confirm']);
Route::post('/user/product_buy_confirm', [BuyController::class, 'buy_confirm']);

Route::get('/user/product_buy_completion', [BuyController::class, 'buy']);
Route::post('/user/product_buy_completion', [BuyController::class, 'buy']);