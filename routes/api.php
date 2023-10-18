<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::group(['middleware' => 'auth:api'], function () {
    Route::post('user/update/{user}', [\App\Http\Controllers\API\UserController::class, 'update']);
});

Route::get('user/info/{user}', [\App\Http\Controllers\API\UserController::class, 'show']);




Route::post('authenticate', [\App\Http\Controllers\API\AuthController::class, 'authenticate']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('login');
