<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ServiceReportController;
use App\Http\Controllers\Api\ReportController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::resource('service-reports', ServiceReportController::class);
    Route::resource('reports', ReportController::class);
});
