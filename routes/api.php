<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\OrderDetailController;
use App\Models\Product;
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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::resource('user_type', UserTypeController::class);


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/product/search', [ProductController::class, 'search']);
    Route::resource('product', ProductController::class, ['verify' => false]);
    Route::resource('product_type', ProductTypeController::class);
    Route::resource('color', ColorController::class);
    Route::resource('size', SizeController::class);
    Route::resource('user', UserController::class);
    Route::resource('order', OrderController::class);
    Route::resource('orderstatus', OrderStatusController::class);
    Route::resource('orderdetail', OrderDetailController::class);
    Route::post('/logout', [AuthController::class, 'logout']);
});
