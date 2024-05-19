<?php

use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

// Route::get('/make/tenant',[TenantController::class,'makeTenant'])->name('make.tenant');

Route::get('/', function(){
    return response()->json(['message' => 'This route is disabled']);
});
