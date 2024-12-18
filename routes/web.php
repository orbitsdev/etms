<?php

use App\Models\Equipment;
use App\Livewire\UserDashboard;
use App\Livewire\ViewEquipment;
use App\Exports\EquipmentExport;
use App\Livewire\AdminDashboard;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReporController;
use App\Http\Controllers\ReportController;
use App\Livewire\Courses\CreateCourse;
use App\Livewire\Courses\EditCourse;
use App\Livewire\Courses\ListCourse;
use App\Livewire\Departments\CreateDepartment;
use App\Livewire\Departments\EditDepartment;
use App\Livewire\Departments\ListDepartment;
use App\Livewire\Equipments\EditEquipment;
use App\Livewire\Equiments\CreateEquipment;
use App\Livewire\Equipments\ListEquipments;
use App\Livewire\Requests\EditEquipmentRequest;
use App\Livewire\Requests\ListRequesterRequest;
use App\Livewire\Requests\RequestEquipmentForm;
use App\Livewire\Sections\CreateSections;
use App\Livewire\Sections\EditSections;
use App\Livewire\Sections\ListSections;
use App\Livewire\User\EditUserDetails;
use App\Livewire\UserDetails\CreateUserDetails;
use App\Livewire\ViewCourse;
use App\Livewire\ViewRequesterRequest;
use App\Livewire\ViewSection;

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
        Route::prefix('/equipments')->name('equipment.')->group(function () {
            Route::get('/', ListEquipments::class)->name('index');
            Route::get('/create', CreateEquipment::class)->name('create');
            Route::get('/edit/{record}', EditEquipment::class)->name('edit');
            Route::get('/view/{record}', ViewEquipment::class)->name('view');
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

        Route::prefix('/requests')->name('requests.')->group(function () {
            Route::get('/', ListRequesterRequest::class)->name('index');
            Route::get('/form', RequestEquipmentForm::class)->name('create');
            Route::get('/form/update/{record}', EditEquipmentRequest::class)->name('edit');
            Route::get('/view/{record}', ViewRequesterRequest::class)->name('view');



        });
        // Route::get('/view/{record}', ViewEquipment::class)->name('view');
        Route::get('/export/equipment/{id}', [ReportController::class, 'exportEquipmentDetails'])->name('export.equipment');


    });


    Route::get('user-details/form', CreateUserDetails::class)->name('user.createUserDetails');

});

Route::get('/unauthorizepage', function () { return 'UnAuthorize'; })->name('unauthorizepage');
