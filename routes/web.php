<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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


