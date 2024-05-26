<?php

use Illuminate\Support\Facades\Route;
use Modules\ReportingAndAnalytics\Http\Controllers\ReportingAndAnalyticsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group([], function () {
    Route::resource('reportingandanalytics', ReportingAndAnalyticsController::class)->names('reportingandanalytics');
});
