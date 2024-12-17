<?php

use App\Models\Equipment;
use App\Livewire\ViewEquipment;
use App\Exports\EquipmentExport;
use App\Livewire\AdminDashboard;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Livewire\Equipments\EditEquipment;
use App\Livewire\Equiments\CreateEquipment;
use App\Livewire\Equipments\ListEquipments;

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
Route::get('/', function () {return view('welcome');});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
    //   return view('dashboard');
    return redirect()->route('admin.dashboard');

    })->name('dashboard');

    Route::get('/admin-dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::prefix('/equipments')->name('equipment.')->group(function () {
        Route::get('/', ListEquipments::class)->name('index');
        Route::get('/create', CreateEquipment::class)->name('create');
        Route::get('/edit/{record}', EditEquipment::class)->name('edit');
        Route::get('/view/{record}', ViewEquipment::class)->name('view');
    });

    Route::get('/view/{record}', ViewEquipment::class)->name('view');
    
    Route::get('/export/equipment/{id}', function ($id) {
        $equipment = Equipment::withAllRelations()->findOrFail($id);

        // Generate a dynamic filename
        $createdDate = $equipment->created_at
            ? $equipment->created_at->format('F j, Y')
            : 'Unknown_Date';
        $filename = $equipment->name . '_' . $equipment->serial_number . '_Created_' . $createdDate . '.xlsx';

        // Export with EquipmentExport
        return Excel::download(new EquipmentExport($equipment), $filename);
    })->name('export.equipment');


});
