<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SchoolController;
use App\Http\Controllers\Admin\ContactsController;
use App\Http\Controllers\Admin\StudentsController as AdminStudentsController;
use App\Http\Controllers\Admin\UsersController as AdminUsersController;
use App\Http\Controllers\Admin\DistrictsController;
use App\Http\Controllers\Admin\TeachersController;
use App\Http\Controllers\Admin\SertificatsController;
use App\Http\Controllers\Admin\DocumentsController;

//super admin routes
Route::name('admin.')->prefix('admin')->middleware(['auth'])->group(function () {

    Route::middleware('role:super-admin')->group(function (){

        Route::resource('users', AdminUsersController::class);
        Route::post('school/activate/{id}', [SchoolController::class, 'activate'])->name('activateSchool');
        Route::resource('districts', DistrictsController::class);
    });


    Route::middleware('role:super-admin|xtb')->group(function (){
        Route::get('/schools', [SchoolController::class, 'index'])->name('schools');
        Route::get('/schools/{school}', [SchoolController::class, 'detail'])->name('schoolDetail');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('students', [AdminStudentsController::class, 'students'])->name('students');
        Route::get('teachers', [TeachersController::class, 'index'])->name('teachers');
        Route::get('students/sertificats', [SertificatsController::class, 'sertificats'])->name('sertificats');
        Route::resource('contacts', ContactsController::class);
        Route::match(['get', 'post'],'student/{id}/sertificat', [AdminController::class, 'sertificat'])->name('sertificatForm');
        Route::resource('documents', DocumentsController::class);
    });

});