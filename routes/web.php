<?php

use App\Models\Request;
use App\Models\Section;
use App\Livewire\Report;
use App\Models\JobOrder;
use App\Models\Equipment;
use App\Mail\RequestUpdate;
use App\Livewire\ViewCourse;
use App\Mail\JobOrderUpdate;
use App\Livewire\ViewSection;
use App\Livewire\UserDashboard;
use App\Livewire\ViewEquipment;
use App\Exports\EquipmentExport;
use App\Livewire\AdminDashboard;
use App\Livewire\Users\ListUsers;
use App\Livewire\Users\CreateUser;
use App\Livewire\Userss\UpdateUser;
use App\Livewire\Courses\EditCourse;
use App\Livewire\Courses\ListCourse;
use App\Livewire\RequesterDashboard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Livewire\Courses\CreateCourse;
use App\Livewire\User\EditUserDetails;
use App\Livewire\ViewRequesterRequest;
use App\Livewire\Sections\EditSections;
use App\Livewire\Sections\ListSections;
use App\Livewire\Feedbacks\ListFeedback;
use App\Livewire\JobOrders\EditJobOrder;
use Filament\Resources\Pages\EditRecord;
use App\Http\Controllers\ReporController;
use App\Livewire\Sections\CreateSections;
use App\Http\Controllers\ReportController;
use App\Livewire\Equipments\EditEquipment;
use App\Livewire\JobOrders\CreateJobOrder;
use App\Livewire\Equiments\CreateEquipment;
use App\Livewire\Equipments\ListEquipments;
use App\Livewire\JobOrders\ListOfJobOrders;
use App\Livewire\Departments\EditDepartment;
use App\Livewire\Departments\ListDepartment;
use App\Http\Controllers\EquipmentController;
use App\Livewire\Equipment\ListEquipmentView;
use App\Livewire\Departments\CreateDepartment;
use App\Livewire\JobOrders\MyJobOrdersRequests;
use App\Livewire\Requests\EditEquipmentRequest;
use App\Livewire\Requests\ListRequesterRequest;
use App\Livewire\Requests\RequestEquipmentForm;
use App\Livewire\UserDetails\CreateUserDetails;
use App\Http\Controllers\NotificationController;
use App\Livewire\Request\ListOfEquipmentRequest;
use App\Livewire\Request\ListOfEquipmetnRequest;
use App\Livewire\JobOrders\ListOfMyJobOrdersRequests;
use App\Livewire\Reports\PropertyAcknowledgementReport;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/dashboard', function () {return view('welcome');});
Route::get('/', function () {
    return redirect()->route('dashboard');
});


Route::middleware([ 'auth:sanctum',config('jetstream.auth_session'), 'verified', ])->group(function () {

   Route::get('/user/update/{record}', EditUserDetails::class)->name('edit-profile');

   Route::get('/dashboard', function () {
       return Auth::user()->getRedirectRouteBasedOnRole();
    }
   )->name('dashboard');

    Route::middleware([
        'ensure.user.details'
        ])->group(function(){

        Route::get('/admin', AdminDashboard::class)->name('admin.dashboard')->middleware(['can:is-admin']);
        Route::get('/requester', UserDashboard::class)->name('user.dashboard');
        Route::get('/feedbacks', RequesterDashboard::class)->name('requester.dashboard');
        Route::middleware(['can:is-admin'])->group(function(){
            Route::prefix('/users')->name('users.')->group(function () {
                Route::get('/', ListUsers::class)->name('index');
                Route::get('/create', CreateUser::class)->name('create');
                Route::get('/edit/{record}', UpdateUser::class)->name('edit');



            });
            Route::prefix('/departments')->name('department.')->group(function () {
                Route::get('/', ListDepartment::class)->name('index');
                Route::get('/create', CreateDepartment::class)->name('create');
                Route::get('/edit/{record}', EditDepartment::class)->name('edit');

            });
            Route::prefix('/courses')->name('courses.')->group(function () {
                Route::get('/', ListCourse::class)->name('index');
                Route::get('/create', CreateCourse::class)->name('create');
                Route::get('/edit/{record}', EditCourse::class)->name('edit');
                Route::get('/view/{record}', ViewCourse::class)->name('view');

            });
            Route::prefix('/sections')->name('sections.')->group(function () {
                Route::get('/', ListSections::class)->name('index');
                Route::get('/create', CreateSections::class)->name('create');
                Route::get('/edit/{record}', EditSections::class)->name('edit');
                Route::get('/view/{record}', ViewSection::class)->name('view');

            });
            Route::prefix('/equipments')->name('equipment.')->group(function () {
                // ->middleware(['can:is-admin'])
                Route::get('/', ListEquipments::class)->name('index');

                Route::get('/create', CreateEquipment::class)->name('create');
                Route::get('/edit/{record}', EditEquipment::class)->name('edit');
                Route::get('/view/{record}', ViewEquipment::class)->name('view');
            });
        });

        Route::get('/equipments/requests-list', ListOfEquipmentRequest::class)->name('requests.lisofequipmentrequests')->middleware(['can:is-admin']);
        Route::get('/job-orders/requests-list', ListOfJobOrders::class)->name('jobordfers.listofjoborders')->middleware(['can:is-admin']);
        Route::get('/feedback/list', ListFeedback::class)->name('feedback.index')->middleware(['can:is-admin']);
        Route::get('report/property-acknowledgement/{requestId}', PropertyAcknowledgementReport::class)
    ->name('report.property-acknowledgement')->middleware(['can:is-admin','request.completed']);

        // public

        Route::get('/list', ListEquipmentView::class)->name('list');



        Route::prefix('/requests')->name('requests.')->group(function () {
            Route::get('/', ListRequesterRequest::class)->name('index');
            Route::get('/new-equipment-request', RequestEquipmentForm::class)->name('create');
            Route::get('/update/equipment-request/{record}', EditEquipmentRequest::class)->name('edit');
            Route::get('/view/{record}', ViewRequesterRequest::class)->name('view');
        });

        Route::prefix('/job-orders')->name('joborders.')->group(function () {
            Route::get('/', ListOfMyJobOrdersRequests::class)->name('index');
            Route::get('/new-request', CreateJobOrder::class)->name('create');
            Route::get('/update/request/{record}', EditJobOrder::class)->name('edit');

        });

        Route::get('/equipments/list', ListEquipmentView::class)->name('equipment.list');
        // Route::get('/view/{record}', ViewEquipment::class)->name('view');
        Route::get('/export/equipment/{id}', [ReportController::class, 'exportEquipmentDetails'])->name('export.equipment');
        Route::get('/export-equipment/{status}', [ReportController::class, 'exportEquipment'])->name('equipment.export');
        Route::get('/export-requests/{status}', [ReportController::class, 'requestExport'])->name('requests.export');
        Route::get('/export-popular-equipment', [ReportController::class, 'exportPopularEquipment'])->name('export.popular.equipment');
        Route::get('/job-orders/export/{status}', [ReportController::class, 'exportJobOrders'])->name('job-orders.export');


    });


    Route::get('user-details/form', CreateUserDetails::class)->name('user.createUserDetails');
    Route::prefix('/reports')->name('reports.')->group(function () {
        Route::get('/', Report::class)->name('index');
    });



});

Route::get('/unauthorizepage', function () { return 'UnAuthorize'; })->name('unauthorizepage');

Route::get('/test/{record}', ViewRequesterRequest::class);

Route::get('/send-email', function(){
    $record = Request::first();
    return view('email.requestupdate',['request'=> $record]);
    // $request= Request::first();


});

// test laytout of joborder emai
Route::get('/joborder-email', function(){
    $jobOrder = JobOrder::first(); // Replace with a specific ID if needed: JobOrder::find(1);



    // Replace with a test email address
    NotificationController::sendJobOrderNotification($jobOrder);

    return 'Job Order email sent!';
});


Route::get('/get-sections/{course_id}', function ($course_id) {
    return Section::where('course_id', $course_id)->get();
});



