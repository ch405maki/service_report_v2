<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Http\Controllers\ServiceReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\MachineController;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/service-reports', [ServiceReportController::class, 'index'])->name('service-reports.index');
    Route::get('/service-reports/show/{id}', [ServiceReportController::class, 'show'])->name('service-reports.show');
    Route::get('/service-reports/create/{id}', [ServiceReportController::class, 'create'])->name('service-reports.create');

    Route::get('/machine', [MachineController::class, 'index'])->name('machine.index');
    Route::get('/machine/create', [MachineController::class, 'create'])->name('machine.create');
});

Route::middleware('auth')->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/reports/show/{reported_by}', [ReportController::class, 'show'])->name('reports.show');

    Route::get('/machine/reports', [ReportController::class, 'machine'])->name('machine.report.index');
    Route::get('/machine/show/{machine_id}', [ReportController::class, 'machine_show'])->name('machine.show');
    
    Route::get('/inventory/reports', [ReportController::class, 'inventory_pc'])->name('inventory.report.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
