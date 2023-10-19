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
    Route::get('user/info/{user}', [\App\Http\Controllers\API\UserController::class, 'show']);
    Route::post('task-notification/store/{id}', [\App\Http\Controllers\API\TaskController::class, 'store']);
    Route::post('task-notification/update/{user}/{task}', [\App\Http\Controllers\API\TaskController::class, 'update']);
    Route::get('task-notification/show/{task}', [\App\Http\Controllers\API\TaskController::class, 'show']);
    Route::get('task-notification/block/{task}', [\App\Http\Controllers\API\TaskController::class, 'delete']);
});


Route::post('register', [\App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\API\AuthController::class, 'login'])->name('login');
