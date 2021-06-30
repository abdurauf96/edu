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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/student/{id}', ['App\Http\Controllers\Api\StudentController', 'getStudent']);