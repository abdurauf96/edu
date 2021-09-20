<?php

use Illuminate\Support\Facades\Route;
use App\Events\StudentEvent;
use App\Models\StudentEvent as StudentEventModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\School\RolesController;
use App\Http\Controllers\School\SchoolController;
use App\Http\Controllers\School\PermissionsController;
use App\Http\Controllers\School\UsersController;
use App\Http\Controllers\School\PaymentsController;
use App\Http\Controllers\School\CashierController;
use App\Http\Controllers\School\TeachersController;
use App\Http\Controllers\School\CoursesController;
use App\Http\Controllers\School\GroupsController;
use App\Http\Controllers\School\StudentsController;
use App\Http\Controllers\School\EventsController;
use App\Http\Controllers\School\MonthsController;
use App\Http\Controllers\School\StaffsController;
use App\Http\Controllers\School\WaitingStudentsController;
use App\Http\Controllers\Admin\AdminController;
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
    return view('welcome');
})->name('homepage');


// Route::get('/welcome', function(){
//     return view('welcome');
// })->middleware('auth:school');


Route::get('/cache', function () {
    \Artisan::call('config:cache');
    return back();
});


//routes for only school admin
Route::group(['prefix' => 'school', 'middleware' => ['auth:school', 'role:admin']], function () {
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('users', UsersController::class);
    Route::get('payment-statistics', [SchoolController::class, 'paymentStatistics'])->name('paymentStatistics');
});

//routes for school admin and cashier
Route::group(['prefix' => 'school', 'middleware' => ['auth:school', 'role:admin,cashier']], function () {
    Route::resource('payments', PaymentsController::class);
    Route::get('cashier/table', [CashierController::class, 'index'])
        ->name('cashierTable');
});


//routes for all school users
Route::middleware('auth:school')->prefix('school')->group(function(){

    Route::get('/dashboard', [SchoolController::class, 'index'])->name('school.dashboard');
    Route::resource('/teachers', TeachersController::class);
    Route::resource('/courses', CoursesController::class);
    Route::resource('/groups', GroupsController::class);
    Route::get('/groups/{id}/add-student', [StudentsController::class, 'createStudentToGroup']);
    // Route::get('/groups/{group_id}/student/{student_id}', ['StudentsController', 'removeFromGroup']);
    
    Route::post('/add-student-to-group', [StudentsController::class, 'addStudentToGroup']);
    Route::resource('/students', StudentsController::class)->except('create');
    Route::get('/bot-students', [StudentsController::class, 'botStudents'])->name('botStudents');
    Route::get('/student-qrcodes', [StudentsController::class, 'studentQrcodes'])->name('studentQrcodes');
    Route::match(['get', 'post'], '/student/change-group', [StudentsController::class, 'changeGroup'])->name('changeStudentGroup');
    
    Route::get('/download-qrcode/{id}', [StudentsController::class, 'downloadQrcode'])->name('downloadQrcode');
    Route::get('/download-image/{image?}', [StudentsController::class, 'downloadImage'])->name('downloadImage');

    Route::get('/events', [EventsController::class, 'events'])->name('events');

    Route::resource('/months', MonthsController::class);
    Route::resource('/staffs', StaffsController::class);
    Route::post('/get-groups', [PaymentsController::class, 'getGroups']);
    Route::get('/reception', [SchoolController::class, 'reception'])->name('schoolReception');
    Route::resource('/waiting-students', WaitingStudentsController::class);

    //event routes
    Route::get('/student/{id}', [StudentsController::class, 'studentEvent'])->middleware('cors');
    Route::get('/staff/{id}', [StaffsController::class, 'staffEvent']);
});

Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
// Route::get('/fire', function () {
//     event(new \App\Events\StudentStaffEvent('test'));
// });

//Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
//Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);


require __DIR__.'/auth.php';


