<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Events\StudentEvent;
use App\Models\StudentEvent as StudentEventModel;
use Illuminate\Support\Facades\DB;
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

Route::get('/test', 'App\Http\Controllers\Admin\AdminController@test');


Route::get('/cache', function () {
    \Artisan::call('config:cache');
    return back();
});


//routes for only admin
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin']], function () {
    Route::resource('roles', 'App\Http\Controllers\Admin\RolesController');
    Route::resource('permissions', 'App\Http\Controllers\Admin\PermissionsController');
    Route::resource('users', 'App\Http\Controllers\Admin\UsersController');
    Route::resource('activitylogs', 'App\Http\Controllers\Admin\ActivityLogsController')->only([
        'index', 'show', 'destroy'
    ]);
    Route::resource('settings', 'App\Http\Controllers\Admin\SettingsController');
    Route::get('payment-statistics', 'App\Http\Controllers\Admin\AdminController@paymentStatistics')->name('paymentStatistics');
});

//routes for admin and cashier
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:admin,cashier']], function () {
    Route::resource('payments', 'App\Http\Controllers\Admin\PaymentsController');
    Route::get('cashier/table', 'App\Http\Controllers\Admin\CashierController@index')
        ->name('cashierTable');
});


//routes for all auth users
Route::middleware('auth')->group(function(){

    Route::get('/dashboard', 'App\Http\Controllers\Admin\AdminController@index')->name('dashboard');
    Route::resource('admin/teachers', 'App\Http\Controllers\Admin\TeachersController');
    Route::resource('admin/courses', 'App\Http\Controllers\Admin\CoursesController');
    Route::resource('admin/groups', 'App\Http\Controllers\Admin\GroupsController');
    Route::get('admin/groups/{id}/add-student', ['App\Http\Controllers\Admin\StudentsController', 'create']);
    // Route::get('admin/groups/{group_id}/student/{student_id}', ['App\Http\Controllers\Admin\StudentsController', 'removeFromGroup']);
    // Route::post('admin/add-student-to-group', ['App\Http\Controllers\Admin\StudentsController', 'addStudentToGroup']);
    Route::resource('admin/students', 'App\Http\Controllers\Admin\StudentsController');

    Route::get('admin/events', 'App\Http\Controllers\Admin\EventsController@events');

    Route::resource('admin/months', 'App\Http\Controllers\Admin\MonthsController');
    Route::resource('admin/staffs', 'App\Http\Controllers\Admin\StaffsController');
    Route::post('/get-groups', 'App\Http\Controllers\Admin\PaymentsController@getGroups');
    Route::get('/reception', function(){
        return view('admin.reception');
    });
    //event routes
    Route::get('/student/{id}', 'App\Http\Controllers\Admin\StudentsController@studentEvent')->middleware('cors');
    Route::get('/staff/{id}', 'App\Http\Controllers\Admin\StaffsController@staffEvent');
});

// Route::get('/fire', function () {
//     event(new \App\Events\StudentStaffEvent('test'));
// });

//Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
//Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);


require __DIR__.'/auth.php';

