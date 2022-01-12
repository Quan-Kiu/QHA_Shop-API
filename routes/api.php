<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ShippingInfoController;
use App\Models\Order;
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

    Route::patch('/user/like/{product}', [UserController::class, 'like']);
    Route::patch('/user/unlike/{product}', [UserController::class, 'unlike']);
    Route::get('/user/getLiked', [UserController::class, 'getLiked']);
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

    Route::get('order/getOrderByUser', [OrderController::class, 'getOrderByUser']);
    Route::resource('order', OrderController::class);

    Route::resource('order_detail', OrderDetailController::class);

    Route::resource('order_status', OrderStatusController::class);

    Route::get('shipping_info/getShippingInfoByUser', [ShippingInfoController::class, 'getShippingInfoByUser']);
    Route::resource('shipping_info', ShippingInfoController::class);

    Route::get('comment/getCommentByProduct/{product}', [CommentController::class, 'getCommentByProduct']);
    Route::resource('comment', CommentController::class);

    Route::get('/logout', [AuthController::class, 'logout']);
});
