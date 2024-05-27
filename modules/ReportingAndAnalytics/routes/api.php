<?php

use Illuminate\Support\Facades\Route;
use modules\ReportingAndAnalytics\Http\Controllers\ReportingAndAnalyticsController;

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

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('reportingandanalytics', ReportingAndAnalyticsController::class)->names('reportingandanalytics');
});
