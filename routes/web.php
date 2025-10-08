<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // // Service
    // Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    // Route::post('/services', [ServiceController::class, 'store'])->name('services.store');
    // Route::put('/services/{service}', [ServiceController::class, 'update'])->name('services.update');
    // Route::delete('/services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');
    // Route::resource('services', ServiceController::class)->names([
    //     'index' => 'services.index',
    //     'create' => 'services.create',
    //     'store' => 'services.store',
    //     'edit' => 'services.edit',
    //     'update' => 'services.update',
    //     'destroy' => 'services.destroy',
    // ]);
    Route::resource('services', ServiceController::class)
        ->only(['index', 'store', 'update', 'destroy']);
    Route::get('/dashboard', function () {
        return inertia('Dashboard');
    })->middleware('check.permission:view.dashboard')->name('dashboard');

    Route::prefix('admin')->middleware('check.permission:manage users')->group(function () {
        Route::resource('roles', RoleController::class);
    });
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
