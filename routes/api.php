<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;


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
    Route::apiResource('product', ProductController::class);
    Route::apiResource('order', OrderController::class);
});

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::apiResource('client', ClientController::class);

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
//});
