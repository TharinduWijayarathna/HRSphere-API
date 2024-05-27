<?php

declare (strict_types = 1);

use App\Http\Controllers\tenant\AuthController;
use App\Http\Controllers\tenant\EmployeeController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

Route::middleware(['api', InitializeTenancyByRequestData::class])->prefix('api')->group(function () {

    Route::get('/', function () {
        return tenant();
    });

    Route::prefix('employee')->group(function () {
        Route::get('/', [EmployeeController::class, 'index']);
        Route::get('/list', [EmployeeController::class, 'list']);
        Route::get('/all', [EmployeeController::class, 'all']);
        Route::post('/store', [EmployeeController::class, 'store']);
        Route::get('/get/{id}', [EmployeeController::class, 'get']);
        Route::post('/update/{id}', [EmployeeController::class, 'update']);
        Route::delete('/delete/{id}', [EmployeeController::class, 'delete']);
    });
});

