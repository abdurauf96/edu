<?php

use Illuminate\Support\Facades\Route;
use App\Events\StudentEvent;
use App\Models\StudentEvent as StudentEventModel;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\School\RolesController;
use App\Http\Controllers\School\MainController;
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
use App\Http\Controllers\School\AppealsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\SchoolController;

use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Student\StudentController;
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
    return redirect('/school/login');
})->name('homepage');


Route::get('/cache', function () {
    \Artisan::call('config:cache');
    return back();
});

Route::get('/download', function () {
    return response()->download('eduapp.apk');
});


//routes for only school admin
Route::group(['prefix' => 'school', 'middleware' => ['auth:user', 'role:admin']], function () {
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('users', UsersController::class);
    Route::get('payment-statistics', [MainController::class, 'paymentStatistics'])->name('paymentStatistics');
});

//routes for school admin and cashier
Route::group(['prefix' => 'school', 'middleware' => ['auth:user', 'role:admin,cashier']], function () {
    Route::resource('payments', PaymentsController::class);
    Route::get('cashier/table', [CashierController::class, 'index'])
        ->name('cashierTable');
});


//routes for all school users
Route::middleware('auth:user')->prefix('school')->group(function () {

    Route::get('/dashboard', [MainController::class, 'index'])->name('school.dashboard');
    Route::resource('/teachers', TeachersController::class);
    Route::resource('/courses', CoursesController::class);
    Route::resource('/groups', GroupsController::class);

    Route::get('/groups/{id}/add-student', [StudentsController::class, 'createStudentToGroup']);
    // Route::get('/groups/{group_id}/student/{student_id}', ['StudentsController', 'removeFromGroup']);

    Route::get('/student/card-generate/{id}', [StudentsController::class, 'generateCard'])->name('generateStudentCard');
    Route::get('/staff/card-generate/{id}', [StaffsController::class, 'generateCard'])->name('generateStaffCard');
    //downloads 
    Route::get('/student/qrcode-download/{code}', [StudentsController::class, 'downloadQrcode'])->name('downloadQrcode');
    Route::get('/student/card-download/{idcard}', [StudentsController::class, 'downloadCard'])->name('downloadCard');

    Route::post('/add-student-to-group', [StudentsController::class, 'addStudentToGroup']);
    Route::resource('/students', StudentsController::class)->except('create');
    Route::get('/bot-students', [StudentsController::class, 'botStudents'])->name('botStudents');
    Route::resource('appeals', AppealsController::class);
    Route::match(['get', 'post'], '/student/change-group', [StudentsController::class, 'changeGroup'])->name('changeStudentGroup');

    

    Route::get('/events', [EventsController::class, 'events'])->name('events');
    Route::get('/events/{type}/{id}', [EventsController::class, 'userEvents'])->name('userEvents');
    
    Route::get('/filter', [EventsController::class, 'filter'])->name('filterEvents');

    Route::resource('/months', MonthsController::class);
    Route::resource('/staffs', StaffsController::class);
    Route::post('/get-groups', [PaymentsController::class, 'getGroups']);
    Route::get('/reception', [MainController::class, 'reception'])->name('schoolReception');
    Route::resource('/waiting-students', WaitingStudentsController::class);

    //attendance routes for websocket, now not using 
    //Route::get('/student/{id}', [StudentsController::class, 'studentEvent'])->middleware('cors');
    //Route::get('/staff/{id}', [StaffsController::class, 'staffEvent']);
});

//admin routes
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/schools', [SchoolController::class, 'index'])->name('admin.schools');
    Route::get('/schools/{school}', [SchoolController::class, 'detail'])->name('admin.schoolDetail');
    Route::post('school/activate/{id}', [SchoolController::class, 'activate'])->name('activateSchool');
});

//teacher routes
Route::middleware('auth:teacher')->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('dashboard',  [TeacherController::class, 'dashboard'])->name('dashboard');
    Route::get('students',  [TeacherController::class, 'students'])->name('students');
    Route::get('profil',  [TeacherController::class, 'profil'])->name('profil');
    Route::get('groups',  [TeacherController::class, 'groups'])->name('groups');
    Route::get('attendance',  [TeacherController::class, 'attendance'])->name('attendance');
    Route::get('info', [TeacherController::class, 'getInfo']);
    Route::post('info', [TeacherController::class, 'updateInfo']); //update teacher information
    Route::post('update-login', [TeacherController::class, 'updateLogin']); //update teacher login credintials
});

//student routes
Route::middleware('auth:student')->prefix('student')->name('student.')->group(function(){
    Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::post('payment', [StudentController::class, 'redirectToPaymentSystem'])->name('redirectToPaymentSystem');
});

//Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
//Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

//handle requests from payment system
Route::any('/handle/{paysys}', function ($paysys) {
    info(file_get_contents('php://input'));
    (new Goodoneuz\PayUz\PayUz)->driver($paysys)->handle();
});


//redirect to payment system or payment form
Route::any('/pay/{paysys}/{key}/{amount}', function ($paysys, $key, $amount) {
    $model = Goodoneuz\PayUz\Services\PaymentService::convertKeyToModel($key);
    $url = request('redirect_url', '/'); // redirect url after payment completed
    $pay_uz = new Goodoneuz\PayUz\PayUz;
    $pay_uz
        ->driver($paysys)
        ->setDescription(true)
        ->redirect($model, $amount, 860, $url);
})->name('paymentSystem');
require __DIR__ . '/auth.php';
