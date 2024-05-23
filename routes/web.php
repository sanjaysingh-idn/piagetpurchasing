<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PurchasingController;

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
    return view('page.login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('user', UserController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('purchasing', PurchasingController::class);
    Route::post('/purchasing/{id}/status', [PurchasingController::class, 'updateStatus'])->name('purchasingStatus');
    // Route::resource('jabatan', JabatanController::class);
    // Route::resource('perjadin', PerjadinController::class);
    // Route::get('/laporanPerjadin', [PerjadinController::class, 'laporanPerjadin'])->name('laporanPerjadin');
    // Route::post('/generate-report', [PerjadinController::class, 'generateReport'])->name('generateReport');

    // Route::get('/perjadin/{id}/bukti', [PerjadinController::class, 'buktiPerjadin'])->name('perjadin.bukti');
    // Route::post('/bukti/store', [PerjadinController::class, 'storeBukti'])->name('bukti.store');
    // Route::delete('bukti/{id}', [PerjadinController::class, 'destroyBukti'])->name('bukti.destroy');
});
