<?php

use App\Http\Controllers\Admin\ServiceController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::middleware(['auth', 'verified'])->group(function () {

    // Dashboard
    Route::get('dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // Service
    Route::get('/service', [ServiceController::class, 'index'])
        ->name('service.index');


});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
