<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\StudentsController as AdminStudentsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;



//super admin routes
Route::name('admin.')->prefix('admin')->middleware(['auth','role:super-admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', AdminUsersController::class);
    Route::get('/schools', [SchoolController::class, 'index'])->name('schools');
    Route::get('/schools/{school}', [SchoolController::class, 'detail'])->name('schoolDetail');
    Route::post('school/activate/{id}', [SchoolController::class, 'activate'])->name('activateSchool');
    Route::get('students', [AdminStudentsController::class, 'students'])->name('students');
    Route::resource('contacts', ContactsController::class);
    Route::match(['get', 'post'],'student/{id}/sertificat', [AdminController::class, 'sertificat'])->name('sertificatForm');
});
