<?php

use Illuminate\Support\Facades\Route;
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
use App\Http\Controllers\School\PlansController;
use App\Http\Controllers\School\OrganizationsController;
use App\Http\Controllers\School\ProfileController;
use App\Http\Controllers\School\LoginsController;

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
    return response()->file('eduapp.apk', [
        'Content-Type'=>'application/vnd.android.package-archive',
        'Content-Disposition'=> 'attachment; filename="android.apk"',
    ]);
});

//Route::get('statistika', [AdminController::class, 'statistika'])->name('statistika');

//routes for only school admin
Route::group(['prefix' => 'school', 'middleware' => ['auth:user','role:admin']], function () {
    Route::resource('roles', RolesController::class);
    Route::resource('permissions', PermissionsController::class);
    Route::resource('users', UsersController::class);
    Route::resource('logins', LoginsController::class);
});

//routes for school admin and cashier
Route::group(['prefix' => 'school', 'middleware' => ['auth:user', 'role:cashier']], function () {
    Route::resource('payments', PaymentsController::class)->except('show');
    Route::get('payments/statistics', [PaymentsController::class, 'statistics'])->name('payments.statistics');
    Route::get('payments/results', [PaymentsController::class, 'results'])->name('payments.results');
    Route::get('payments/debtors', [PaymentsController::class, 'debtors'])->name('payments.debtors');
});


//routes for all school users
Route::middleware(['auth:user', 'schoolStatus'])->prefix('school')->group(function () {

    Route::get('/dashboard', [MainController::class, 'index'])->name('school.dashboard');
    Route::resource('/teachers', TeachersController::class);
    Route::resource('/courses', CoursesController::class);
    Route::resource('/groups', GroupsController::class);
    Route::resource('/organizations', OrganizationsController::class);

    //xisobotlar
    Route::get('reports/students', \App\Http\Livewire\School\StudentsReport::class)->name('reports.students');
    Route::get('reports/groups', \App\Http\Livewire\School\GroupsReport::class)->name('reports.groups');

    Route::get('/student-statistics', [StudentsController::class, 'statistics'])->name('students.statistics');
    Route::resource('profile', ProfileController::class);

    //groups
    Route::get('/today/groups', [MainController::class, 'todayGroups'])->name('todayGroups');
    Route::get('/groups/{id}/add-student', [StudentsController::class, 'createStudentToGroup']);
    // Route::get('/groups/{group_id}/student/{student_id}', ['StudentsController', 'removeFromGroup']);

    //card generate
    Route::get('/student/card-generate/{id}', [StudentsController::class, 'generateCard'])->name('generateStudentCard');
    Route::get('/staff/card-generate/{id}', [StaffsController::class, 'generateCard'])->name('generateStaffCard');

    //downloads
    Route::get('/staff/qrcode-download/{id}', [StaffsController::class, 'downloadStaffQrcode'])->name('downloadStaffQrcode');
    Route::get('/student/qrcode-download/{id}', [StudentsController::class, 'downloadQrcode'])->name('downloadQrcode');
    Route::get('/student/card-download/{idcard}', [StudentsController::class, 'downloadCard'])->name('downloadCard');

    //students
    Route::get('/student/event/{id}', [StudentsController::class, 'event'])->name('studentEvent');
    Route::post('/add-student-to-group', [StudentsController::class, 'addStudentToGroup'])->name('students.addToGroup');
    Route::get('/student/create', [StudentsController::class, 'addStudent'])->name('school.addStudent');
    Route::post('/student/message/store', [StudentsController::class, 'storeMessage'])->name('storeStudentMessage');
    Route::match(['GET', 'POST'],'/students/{id}/create-sertificate', [StudentsController::class, 'createSertificate'])->name('createSertificate');

    //select groups for managers
    Route::match(['post', 'get'], '/groups/select/managers', [GroupsController::class, 'selectManagers'])->name('school.groups.selectManagers');

    Route::resource('students', StudentsController::class);
    Route::get('/bot-students', [StudentsController::class, 'botStudents'])->name('botStudents');
    Route::resource('appeals', AppealsController::class);
    Route::post('/student/change-group', [StudentsController::class, 'changeGroup'])->name('changeStudentGroup');

    //events
    Route::get('/events', [EventsController::class, 'events'])->name('events');
    Route::get('/events/{type}/{id}', [EventsController::class, 'userEvents'])->name('userEvents');

    Route::resource('/months', MonthsController::class);
    Route::resource('/staffs', StaffsController::class);
    Route::post('/get-groups', [PaymentsController::class, 'getGroups']);
    Route::resource('/waiting-students', WaitingStudentsController::class);

    Route::get('/course/{id}/plans', [PlansController::class, 'plans'])->name('coursePlans');

    Route::get('/add/course-payment', [PaymentsController::class, 'addMonthlyPayment'])->name('school.addMonthlyPayment');
    Route::get('/messages/index', [MessagesController::class, 'index'])->name('messages.index');

});
Route::get('/school/student/{id}/download-contract', [StudentsController::class, 'downloadContract'])->name('students.downloadContract');

require __DIR__.'/superadmin.php';
require __DIR__.'/teacher.php';
require __DIR__ . '/auth.php';


//student routes
Route::middleware('auth:student')->prefix('student')->name('student.')->group(function(){
    Route::get('dashboard', [StudentController::class, 'dashboard'])->name('dashboard');
    Route::post('payment', [StudentController::class, 'redirectToPaymentSystem'])->name('redirectToPaymentSystem');
});

Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

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



Route::post('/student/pay', function (\Illuminate\Http\Request $request) {
    //dd($request->all());
    $student=\App\Models\Student::findOrFail($request->student_id);
    $student->debt=$request->debt;
    $student->save();
    return back();
});
