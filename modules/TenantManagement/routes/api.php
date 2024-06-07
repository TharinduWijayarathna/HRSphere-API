<?php

declare (strict_types = 1);

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;
use modules\TenantManagement\Http\Controllers\TenantManagementController;

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

});


Route::prefix('tenant')->group(function () {
    Route::get('/list', [TenantManagementController::class, 'list']);
    Route::get('/filter', [TenantManagementController::class, 'filter']);
    Route::post('/store', [TenantManagementController::class, 'store']);
    Route::get('/get/{id}', [TenantManagementController::class, 'get']);
    Route::post('/update/{id}', [TenantManagementController::class, 'update']);
    Route::delete('/delete/{id}', [TenantManagementController::class, 'delete']);
});
