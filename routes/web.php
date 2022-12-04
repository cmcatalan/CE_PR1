<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [CategoryController::class, 'all']);
Route::get('/categories', [CategoryController::class, 'all']);
Route::get('/category/{id}', [CategoryController::class, 'single']);
Route::get('/product/{id}', [ProductController::class, 'single']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/add/{id}', [CartController::class, 'add']);
Route::patch('/cart/update', [CartController::class, 'update']);
Route::delete('/cart/remove', [CartController::class, 'remove']);
Route::get('/checkout', [CartController::class, 'checkout']);
