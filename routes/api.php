<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\ServiceReportController;
use App\Http\Controllers\Api\ReportController;
use App\Http\Controllers\Api\StaffController;
use App\Http\Controllers\Api\MachineController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::resource('service-reports', ServiceReportController::class);
Route::middleware(['auth:sanctum', 'throttle:unlimited'])->group(function () {
    Route::resource('reports', ReportController::class);
    Route::resource('staff', StaffController::class);
});

Route::post('/machines', [MachineController::class, 'store']);
Route::put('/machines/{id}/assign-user', [MachineController::class, 'assignUser'])->name('machines.assignUser');