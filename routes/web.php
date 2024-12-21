<?php

use App\Models\Request;
use App\Livewire\Report;
use App\Models\Equipment;
use App\Mail\RequestUpdate;
use App\Livewire\ViewCourse;
use App\Livewire\ViewSection;
use App\Livewire\UserDashboard;
use App\Livewire\ViewEquipment;
use App\Exports\EquipmentExport;
use App\Livewire\AdminDashboard;
use App\Livewire\Courses\EditCourse;
use App\Livewire\Courses\ListCourse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Livewire\Courses\CreateCourse;
use App\Livewire\User\EditUserDetails;
use App\Livewire\ViewRequesterRequest;
use App\Livewire\Sections\EditSections;
use App\Livewire\Sections\ListSections;
use App\Http\Controllers\ReporController;
use App\Livewire\Sections\CreateSections;
use App\Http\Controllers\ReportController;
use App\Livewire\Equipments\EditEquipment;
use App\Livewire\Equiments\CreateEquipment;
use App\Livewire\Equipments\ListEquipments;
use App\Livewire\Departments\EditDepartment;
use App\Livewire\Departments\ListDepartment;
use App\Http\Controllers\EquipmentController;
use App\Livewire\Equipment\ListEquipmentView;
use App\Livewire\Departments\CreateDepartment;
use App\Livewire\Requests\EditEquipmentRequest;
use App\Livewire\Requests\ListRequesterRequest;
use App\Livewire\Requests\RequestEquipmentForm;
use App\Livewire\UserDetails\CreateUserDetails;
use App\Livewire\Request\ListOfEquipmentRequest;
use App\Livewire\Request\ListOfEquipmetnRequest;

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
           
        Route::get('/admin', AdminDashboard::class)->name('admin.dashboard');
        Route::get('/requester', UserDashboard::class)->name('user.dashboard');
        Route::middleware(['can:is-admin'])->group(function(){
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
        Route::get('/equipments/requests', ListOfEquipmentRequest::class)->name('requests.lisofequipmentrequests')->middleware(['can:is-admin']);

        // public 

        Route::get('/list', ListEquipmentView::class)->name('list');
     
     

        Route::prefix('/requests')->name('requests.')->group(function () {
            Route::get('/', ListRequesterRequest::class)->name('index');
            Route::get('/form', RequestEquipmentForm::class)->name('create');
            Route::get('/form/update/{record}', EditEquipmentRequest::class)->name('edit');
            Route::get('/view/{record}', ViewRequesterRequest::class)->name('view');
        });

        Route::get('/equipments/list', ListEquipmentView::class)->name('equipment.list');
        // Route::get('/view/{record}', ViewEquipment::class)->name('view');
        Route::get('/export/equipment/{id}', [ReportController::class, 'exportEquipmentDetails'])->name('export.equipment');
        Route::get('/export-equipment/{status}', [ReportController::class, 'exportEquipment'])->name('equipment.export');
        Route::get('/export-requests/{status}', [ReportController::class, 'requestExport'])->name('requests.export');
        Route::get('/export-popular-equipment', [ReportController::class, 'exportPopularEquipment'])->name('export.popular.equipment');




    });


    Route::get('user-details/form', CreateUserDetails::class)->name('user.createUserDetails');
    Route::prefix('/reports')->name('reports.')->group(function () {
        Route::get('/', Report::class)->name('index');
    });



});

Route::get('/unauthorizepage', function () { return 'UnAuthorize'; })->name('unauthorizepage');

Route::get('/test/{record}', ViewRequesterRequest::class);

Route::get('/send-email', function(){
    // $record = Request::first();
    // return view('email.requestupdate',['record'=> $record]);
    // $request= Request::first();
    

});