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
use App\Livewire\Equipments\EditEquipment;
use App\Livewire\Equiments\CreateEquipment;
use App\Livewire\Equipments\ListEquipments;
use App\Livewire\UserDetails\CreateUserDetails;

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
   
   Route::get('/dashboard', function () {
    
      return Auth::user()->getRedirectRouteBasedOnRole(); 
    }
   )->name('dashboard');

    Route::middleware([ 'ensure.user.details'])->group(function(){
        Route::get('/admin', AdminDashboard::class)->name('admin.dashboard');
        Route::get('/', UserDashboard::class)->name('user.dashboard');
        Route::prefix('/equipments')->name('equipment.')->group(function () {
            Route::get('/', ListEquipments::class)->name('index');
            Route::get('/create', CreateEquipment::class)->name('create');
            Route::get('/edit/{record}', EditEquipment::class)->name('edit');
            Route::get('/view/{record}', ViewEquipment::class)->name('view');
        });
    
        Route::get('/view/{record}', ViewEquipment::class)->name('view');
        Route::get('/export/equipment/{id}', [ReportController::class, 'exportEquipmentDetails'])->name('export.equipment');
    });
   
   
    Route::get('user-details/form', CreateUserDetails::class)->name('user.createUserDetails');


});
