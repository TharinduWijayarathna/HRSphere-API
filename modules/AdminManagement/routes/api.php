<?php

use Illuminate\Support\Facades\Route;
use modules\AdminManagement\Http\Controllers\AdminManagementController;

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
    Route::prefix('admin')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/', [AdminManagementController::class, 'admin']);
            Route::post('/logout', [AdminManagementController::class, 'admin_logout']);
        });
        Route::post('/register', [AdminManagementController::class, 'admin_register']);
        Route::post('/login', [AdminManagementController::class, 'admin_login']);
    });
});
