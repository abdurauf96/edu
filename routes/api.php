<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::post('register', ['App\Http\Controllers\Api\RegisterController', 'register']);
//Route::post('login', ['App\Http\Controllers\Api\RegisterController', 'login']);

Route::post('student/login', ['App\Http\Controllers\Api\StudentLoginController', 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('/payment-statistics/{year}/{month}', '\App\Http\Controllers\Api\PaymentController@paymentStatistics')->name('user');
});

Route::middleware(['auth:student-api'])->prefix('student')->group(function () {
    Route::get('fullinfo', ['App\Http\Controllers\Api\StudentController', 'studentFullInfo']);
    Route::get('payments', ['App\Http\Controllers\Api\StudentController', 'getStudentPayments']);
    Route::get('events', ['App\Http\Controllers\Api\StudentController', 'getStudentEvents']);
    Route::post('update-info', ['App\Http\Controllers\Api\StudentController', 'updateInfo']);
    Route::post('update-image', ['App\Http\Controllers\Api\StudentController', 'updateImage']);
    Route::post('update-password', ['App\Http\Controllers\Api\StudentController', 'updatePassword']);
});


Route::get('/event/{type}/{id}/{time}', ['App\Http\Controllers\Api\EventsController', 'event']);

Route::get('/courses', ['App\Http\Controllers\Api\BotController', 'getCourses']);
Route::post('/saveBotStudent', ['App\Http\Controllers\Api\BotController', 'saveBotStudent']);
Route::get('/botStudent', ['App\Http\Controllers\Api\BotController', 'getOneStudent']);
Route::post('/appeals', ['App\Http\Controllers\Api\AppealsController', 'store']);


Route::get('/student/{id}', ['App\Http\Controllers\Api\StudentController', 'getStudent']);
//get info about student course
Route::get('/student/{id}/plans', ['App\Http\Controllers\Api\StudentController', 'coursePlans']);
