<?php

declare (strict_types = 1);

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByRequestData;

Route::middleware(['api', InitializeTenancyByRequestData::class])->prefix('tenant')->group(function () {

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

Route::middleware('api')->prefix('auth')->group(function () {
    Route::prefix('user')->group(function () {
        Route::middleware('auth:sanctum')->group(function () {
            Route::get('/', [AuthController::class, 'user']);
            Route::post('/logout', [AuthController::class, 'logout']);
        });
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });
});
