<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;


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

Route::middleware('jwt.auth')->group(function() {
//    Route::apiResource('product', ProductController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('order', OrderController::class);
    Route::apiResource('client', ClientController::class);
    Route::post('refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::apiResource('user', UserController::class);
});

Route::post('login', [AuthController::class, 'login'])->name('login');

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
//});
