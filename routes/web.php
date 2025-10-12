<?php

use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRolePermissionController;
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
    // Route::get('/dashboard', function () {
    //     return inertia('Dashboard');
    // })->middleware('check.permission:view.dashboard')->name('dashboard');

    // Route::prefix('admin')->name('admin.')->group(function () {
    //     Route::resource('roles', RoleController::class);
    // });
    Route::prefix('admin')->name('admin.')->middleware('check.permission:roles')->group(function () {
        Route::resource('users', UserController::class);
        Route::post('users/{user}/toggle-active', [UserController::class, 'toggleActive'])->name('users.toggleActive');
        Route::get('roles', [App\Http\Controllers\Admin\RolePermissionController::class, 'index'])->name('roles.index');

        Route::post('roles', [App\Http\Controllers\Admin\RolePermissionController::class, 'storeRole'])->name('roles.store');
        Route::post('permissions', [App\Http\Controllers\Admin\RolePermissionController::class, 'storePermission'])->name('permissions.store');

        Route::put('roles/{id}', [App\Http\Controllers\Admin\RolePermissionController::class, 'updateRole'])->name('roles.update');
        Route::delete('roles/{id}', [App\Http\Controllers\Admin\RolePermissionController::class, 'deleteRole'])->name('roles.destroy');
        Route::delete('permissions/{id}', [App\Http\Controllers\Admin\RolePermissionController::class, 'deletePermission'])->name('permissions.destroy');
        Route::get('user-role-permission', [UserRolePermissionController::class, 'index'])->name('user.role.permission.index');
        Route::post('user/{user}/assign-role', [UserRolePermissionController::class, 'assignRole'])->name('user.assign.role');
        Route::post('user/{user}/assign-permission', [UserRolePermissionController::class, 'assignPermission'])->name('user.assign.permission');
        Route::delete('user/{user}/role/{role}', [UserRolePermissionController::class, 'removeRole'])->name('user.remove.role');
        Route::delete('user/{user}/permission/{permission}', [UserRolePermissionController::class, 'removePermission'])->name('user.remove.permission');
        Route::delete('/admin/user/{user}/remove-all', [UserRolePermissionController::class, 'removeAllAssignments'])
            ->name('user.remove.all');

    });
});

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
