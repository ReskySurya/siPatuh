<?php

use App\Http\Controllers\DailyTestController;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/', function () {
    return redirect()->route('login');
});

// Rute untuk menampilkan form login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Rute untuk memproses login
Route::post('/login', [LoginController::class, 'login']);

// Rute untuk logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Rute yang dilindungi untuk User (superadmin dan supervisor)
Route::middleware(['checkrole:superadmin,supervisor'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rute yang dilindungi untuk Officer
Route::middleware(['checkrole:officer'])->group(function () {
    Route::get('/officer/dashboard', function () {
        return view('officer.dashboard');
    })->name('officer.dashboard');
});

// Rute Daily Task yang dapat diakses oleh semua pengguna yang sudah login
Route::middleware(['checkrole:superadmin,supervisor,officer'])->group(function () {
    Route::prefix('daily-test')->name('daily-test.')->group(function () {
        // X-ray routes
        Route::prefix('x-ray')->name('x-ray.')->group(function () {
            Route::get('/pscp-cabin-utara', [DailyTestController::class, 'pscpCabinUtara'])->name('pscp-cabin-utara');
            Route::get('/pscp-cabin-selatan', [DailyTestController::class, 'pscpCabinSelatan'])->name('pscp-cabin-selatan');
            Route::get('/hbscp-bagasi-barat', [DailyTestController::class, 'hbscpBagasiBarat'])->name('hbscp-bagasi-barat');
            Route::get('/hbscp-bagasi-timur', [DailyTestController::class, 'hbscpBagasiTimur'])->name('hbscp-bagasi-timur');
        });

        // WTMD routes
        Route::prefix('wtmd')->name('wtmd.')->group(function () {
            Route::get('/pos-timur', [DailyTestController::class, 'wtmdPosTimur'])->name('pos-timur');
            Route::get('/pscp-utara', [DailyTestController::class, 'wtmdPscpUtara'])->name('pscp-utara');
            Route::get('/pscp-selatan', [DailyTestController::class, 'wtmdPscpSelatan'])->name('pscp-selatan');
        });

        // HHMD routes
        Route::prefix('hhmd')->name('hhmd.')->group(function () {
            Route::get('/hbscp', [DailyTestController::class, 'hhmdHbscp'])->name('hbscp');
            Route::get('/pos-timur', [DailyTestController::class, 'hhmdPosTimur'])->name('pos-timur');
            Route::get('/pos-barat', [DailyTestController::class, 'hhmdPosBarat'])->name('pos-barat');
            Route::get('/pscp-utara', [DailyTestController::class, 'hhmdPscpUtara'])->name('pscp-utara');
            Route::get('/pscp-selatan', [DailyTestController::class, 'hhmdPscpSelatan'])->name('pscp-selatan');
            Route::get('/kedatangan', [DailyTestController::class, 'hhmdKedatangan'])->name('kedatangan');
        });
    });
});
