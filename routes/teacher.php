<?php
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\PlansController as TeacherPlansController;

//teacher routes
Route::middleware('auth:teacher')->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('dashboard',  [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('students',  [TeacherController::class, 'students'])->name('students');
    Route::get('profil',  [TeacherController::class, 'profil'])->name('profil');
    Route::get('groups',  [TeacherController::class, 'groups'])->name('groups');
    Route::get('attendance',  [TeacherController::class, 'attendance'])->name('attendance');
    Route::get('info', [TeacherController::class, 'getInfo']);
    Route::get('course-plans/{id}', [TeacherController::class, 'coursePlans'])->name('coursePlans');
    Route::resource('plans', TeacherPlansController::class);
    Route::post('info', [TeacherController::class, 'updateInfo']); //update teacher information
    Route::post('update-login', [TeacherController::class, 'updateLogin']); //update teacher login credintials

    //student attandance manual
    Route::post('students/attandance', [TeacherController::class, 'studentsAttandance'])->name('studentsAttandance');
});
