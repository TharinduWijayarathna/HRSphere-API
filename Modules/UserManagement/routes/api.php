<?php

use Illuminate\Support\Facades\Route;
use Modules\UserManagement\Http\Controllers\UserManagementController;

/*
 *--------------------------------------------------------------------------
 * API Routes
 *--------------------------------------------------------------------------
 *
 * Here is where you can register API routes for your application. These
 * routes are loaded by the RouteServiceProvider within a group which
 * is assigned the "api" middleware group. Enjoy building your API!
 *
*/

Route::middleware('api')->group(function () {
    Route::prefix('user')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/', [UserManagementController::class, 'user']);
            Route::post('/logout', [UserManagementController::class, 'logout']);
        });
        Route::post('/register', [UserManagementController::class, 'register']);
        Route::post('/login', [UserManagementController::class, 'login']);
    });
});
