<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
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


Route::middleware('auth:sanctum')->group(function () {
    Route::resource('user_type', UserTypeController::class);


    Route::get('/refreshtoken', [UserController::class, 'refreshtoken']);
    Route::put('/user/changePassword', [UserController::class, 'changePassword']);
    Route::resource('user', UserController::class);

    Route::get('/product/search', [ProductController::class, 'search']);
    Route::get('/product/discount', [ProductController::class, 'getDiscountProduct']);
    Route::resource('product', ProductController::class);

    Route::resource('product_type', ProductTypeController::class);

    Route::get('cart/getCartByUser', [CartController::class, 'getCartByUser']);

    Route::resource('cart', CartController::class);


    Route::resource('color', ColorController::class);

    Route::resource('size', SizeController::class);
    Route::resource('order', OrderController::class);
    Route::resource('orderstatus', OrderStatusController::class);

    Route::post('/logout', [AuthController::class, 'logout']);
});
