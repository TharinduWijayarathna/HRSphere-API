<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('employee')->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/list', [EmployeeController::class, 'list']);
    Route::get('/all', [EmployeeController::class, 'all']);
    Route::post('/store', [EmployeeController::class, 'store']);
    Route::get('/get/{id}', [EmployeeController::class, 'get']);
    Route::post('/update/{id}', [EmployeeController::class, 'update']);
    Route::delete('/delete/{id}', [EmployeeController::class, 'delete']);
});
