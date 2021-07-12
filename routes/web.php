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

Route::get('/test', function () {

    $students=\App\Models\Student::all();
    
    set_time_limit(300);
    foreach($students as $student){
        $qrcode_info=<<<TEXT
        id: {$student->id}
        type: student
TEXT;
        $filename=$student->name.'-'.time().'.png';
        \QrCode::size(600)
            ->format('png')
            ->color(41,38,91)
            ->margin(5) 
            ->errorCorrection('H')
            ->merge('/public/admin/images/DC.png', .3)
            ->generate($qrcode_info, public_path('admin/images/qrcodes/'.$filename));
            $student->code=$filename;
            $student->save();
    }
    
    return redirect('/');
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

    Route::get('/dashboard', 'App\Http\Controllers\Admin\AdminController@index')->middleware(['auth'])->name('dashboard');

    Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
    Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

    Route::resource('admin/teachers', 'App\Http\Controllers\Admin\TeachersController');
    Route::resource('admin/courses', 'App\Http\Controllers\Admin\CoursesController');
    Route::resource('admin/groups', 'App\Http\Controllers\Admin\GroupsController');
    Route::get('admin/groups/{id}/add-student', ['App\Http\Controllers\Admin\StudentsController', 'create']);
    // Route::get('admin/groups/{group_id}/student/{student_id}', ['App\Http\Controllers\Admin\StudentsController', 'removeFromGroup']);
    // Route::post('admin/add-student-to-group', ['App\Http\Controllers\Admin\StudentsController', 'addStudentToGroup']);
    Route::resource('admin/students', 'App\Http\Controllers\Admin\StudentsController');
    Route::get('admin/student/{id}/information', 'App\Http\Controllers\Admin\StudentsController@studentInfo');
    Route::get('admin/events', 'App\Http\Controllers\Admin\EventsController@events');
    Route::resource('admin/payments', 'App\Http\Controllers\Admin\PaymentsController');
    Route::resource('admin/months', 'App\Http\Controllers\Admin\MonthsController');
    Route::resource('admin/staffs', 'App\Http\Controllers\Admin\StaffsController');
    Route::post('/get-groups', 'App\Http\Controllers\Admin\PaymentsController@getGroups');
});

require __DIR__.'/auth.php';

