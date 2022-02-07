<?php

use App\Http\Controllers\Auth\SchoolController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

// Route::get('/register', [RegisteredUserController::class, 'create'])
//                 ->middleware('guest')
//                 ->name('register');

// Route::post('/register', [RegisteredUserController::class, 'store'])
//                ->middleware('guest');

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
                ->middleware('guest')
                ->name('login');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

//school routes
Route::get('school/register', [SchoolController::class, 'showRegisterForm'])->name('schoolRegisterForm');
Route::post('school/register', [SchoolController::class, 'register'])->name('schoolRegister');
Route::get('school/login', [SchoolController::class, 'showLoginForm'])
        ->middleware('guest:user')
        ->name('schoolLoginForm');
Route::post('school/login', [SchoolController::class, 'login'])->name('schoolLogin');

Route::post('/school/logout', [SchoolController::class, 'destroy'])
                ->middleware('auth:user')
                ->name('school.logout');



Route::get('/teacher/login', [\App\Http\Controllers\Auth\TeacherController::class, 'showLoginForm'])->middleware('guest:teacher');
Route::post('/teacher/login', [\App\Http\Controllers\Auth\TeacherController::class, 'login'])->name('teacherLogin');
Route::post('/teacher/logout', [\App\Http\Controllers\Auth\TeacherController::class, 'destroy'])->name('teacherLogout');


Route::get('/student/login', [\App\Http\Controllers\Auth\StudentController::class, 'showLoginForm'])->middleware('guest:student');
Route::post('/student/login', [\App\Http\Controllers\Auth\StudentController::class, 'login'])->name('studentLogin');
Route::post('/student/logout', [\App\Http\Controllers\Auth\StudentController::class, 'destroy'])->name('studentLogout');