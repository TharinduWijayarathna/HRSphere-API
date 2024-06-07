<?php

declare (strict_types = 1);

use Illuminate\Support\Facades\Route;
use modules\EmployeeManagement\Http\Controllers\EmployeeManagementController;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

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

Route::middleware(['api', InitializeTenancyByRequestData::class])->prefix('api')->group(function () {
    Route::prefix('employee')->group(function () {
        Route::get('/list', [EmployeeManagementController::class, 'list']);
        Route::get('/filter', [EmployeeManagementController::class, 'all']);
        Route::post('/store', [EmployeeManagementController::class, 'store']);
        Route::get('/get/{id}', [EmployeeManagementController::class, 'get']);
        Route::post('/update/{id}', [EmployeeManagementController::class, 'update']);
        Route::delete('/delete/{id}', [EmployeeManagementController::class, 'delete']);
    });

});
