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

Route::post('register', ['App\Http\Controllers\Api\RegisterController', 'register']);
Route::post('login', ['App\Http\Controllers\Api\RegisterController', 'login']);
Route::post('/student/login', ['App\Http\Controllers\Api\StudentLoginController', 'login']);

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['auth:student-api'])->group(function () {
    Route::get('/student/fullinfo/{id}', ['App\Http\Controllers\Api\StudentController', 'studentFullInfo']);
    Route::get('/student/{id}/payments', ['App\Http\Controllers\Api\StudentController', 'getStudentPayments']);
});

Route::get('/student/{id}', ['App\Http\Controllers\Api\StudentController', 'getStudent']);
Route::get('/event/{type}/{id}/{status}/{time}', ['App\Http\Controllers\Api\EventsController', 'event']);