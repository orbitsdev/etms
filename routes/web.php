<?php

use App\Livewire\AdminDashboard;
use Illuminate\Support\Facades\Route;

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


});
