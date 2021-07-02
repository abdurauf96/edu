<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/cache', function () {
    \Artisan::call('config:cache');
    return back();
});

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::resource('roles', 'App\Http\Controllers\Admin\RolesController');
    Route::resource('permissions', 'App\Http\Controllers\Admin\PermissionsController');
    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');
    Route::resource('activitylogs', 'App\Http\Controllers\Admin\ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('settings', 'App\Http\Controllers\Admin\SettingsController');
});

Route::middleware(['auth'])->group(function(){

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth'])->name('dashboard');

    Route::get('/admin', 'App\Http\Controllers\Admin\AdminController@index');
    // Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    // Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

    Route::resource('admin/teachers', 'App\Http\Controllers\Admin\TeachersController');
    Route::resource('admin/courses', 'App\Http\Controllers\Admin\CoursesController');
    Route::resource('admin/groups', 'App\Http\Controllers\Admin\GroupsController');
    Route::get('admin/groups/{id}/add-student', ['App\Http\Controllers\Admin\StudentsController', 'create']);
    // Route::get('admin/groups/{group_id}/student/{student_id}', ['App\Http\Controllers\Admin\StudentsController', 'removeFromGroup']);
    // Route::post('admin/add-student-to-group', ['App\Http\Controllers\Admin\StudentsController', 'addStudentToGroup']);
    Route::resource('admin/students', 'App\Http\Controllers\Admin\StudentsController');
    Route::get('admin/student-events', 'App\Http\Controllers\Admin\StudentsController@events');
    Route::resource('admin/payments', 'App\Http\Controllers\Admin\PaymentsController');
    Route::resource('admin/months', 'App\Http\Controllers\Admin\MonthsController');

    Route::post('/get-groups', 'App\Http\Controllers\Admin\PaymentsController@getGroups');
});

require __DIR__.'/auth.php';
