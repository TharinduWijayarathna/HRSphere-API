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

});

