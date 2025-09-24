<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [AuthController::class, 'login']);
//logout
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
//products
Route::apiResource('/api-products', ProductController::class)->middleware('auth:sanctum');
//categories
Route::apiResource('/api-categories', CategoryController::class)->middleware('auth:sanctum');



