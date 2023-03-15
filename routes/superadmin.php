<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\StudentsController as AdminStudentsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\DistrictsController;

//super admin routes
Route::name('admin.')->prefix('admin')->middleware(['auth'])->group(function () {
    Route::middleware('role:super-admin')->group(function (){
        Route::resource('users', AdminUsersController::class);
        Route::post('school/activate/{id}', [SchoolController::class, 'activate'])->name('activateSchool');
        Route::resource('districts', DistrictsController::class);
    });
    Route::middleware('role:super-admin')->group(function (){
        Route::get('/schools', [SchoolController::class, 'index'])->name('schools');
        Route::get('/schools/{school}', [SchoolController::class, 'detail'])->name('schoolDetail');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('students', [AdminStudentsController::class, 'students'])->name('students');
    });
});
