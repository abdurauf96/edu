<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DistrictsController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\StudentsController as AdminStudentsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;

//super admin routes
Route::name('admin.')->prefix('admin')->middleware(['auth:admin', 'role:super-admin'])->group(function () {
        Route::resource('users', AdminUsersController::class);

        Route::resource('roles', RoleController::class);
        Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
        Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');

        Route::resource('permissions', PermissionsController::class);
        Route::post('/permissions/{permission}/roles', [PermissionsController::class, 'assignRole'])->name('permissions.roles');
        Route::delete('/permissions/{permission}/roles/{role}', [PermissionsController::class, 'removeRole'])->name('permissions.roles.remove');

        Route::post('school/activate/{id}', [SchoolController::class, 'activate'])->name('activateSchool');
        Route::resource('districts', DistrictsController::class);
        Route::get('/schools', [SchoolController::class, 'index'])->name('schools');
        Route::get('/schools/{school}', [SchoolController::class, 'detail'])->name('schoolDetail');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('students', [AdminStudentsController::class, 'students'])->name('students');
});
