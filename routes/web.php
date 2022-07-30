<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::controller(AuthController::class)->group(function() { 
    Route::get('/', [AuthController::class, 'index'])->name('login');
    Route::post('/process', [AuthController::class, 'process'])->name('login-process');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
Route::controller(DashboardController::class)->group(function() {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/dashboard/save', [DashboardController::class, 'store'])->name('save.master');
    Route::post('/dashboard/update', [DashboardController::class, 'update'])->name('save.edit');
    Route::post('/dashboard/edit', [DashboardController::class, 'edit'])->name('edit');
    Route::post('/dashboard/delete', [DashboardController::class, 'destroy'])->name('delete');
});

Route::controller(PasienController::class)->group(function(){
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien');
    Route::post('/pasien/save', [PasienController::class, 'store'])->name('save.master.pasien');
    Route::post('/pasien/update', [PasienController::class, 'update'])->name('save.edit.pasien');
    Route::post('/pasien/edit', [PasienController::class, 'edit'])->name('edit.pasien');
    Route::post('/pasien/delete', [PasienController::class, 'destroy'])->name('delete.pasien');
    Route::post('/pasien/search', [PasienController::class, 'search'])->name('search');
});