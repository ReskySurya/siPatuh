<?php

use App\Http\Controllers\DailyTestController;
use App\Http\Controllers\HHMDFormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\SignatureController;
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

// Rute yang dilindungi untuk Officer
Route::middleware(['checkrole:officer'])->group(function () {
    Route::get('/officer/dashboard', function () {
        return view('officer.dashboard');
    })->name('officer.dashboard');
});

// Rute yang dilindungi untuk User (superadmin dan supervisor)
Route::middleware(['checkrole:superadmin,supervisor'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/masterdata', [MasterDataController::class, 'index'])->name('masterdata.index');
    Route::post('/masterdata/add-user', [MasterDataController::class, 'addUser'])->name('masterdata.addUser');
    Route::post('/masterdata/add-officer', [MasterDataController::class, 'addOfficer'])->name('masterdata.addOfficer');
    Route::put('/masterdata/officer/{id}', [MasterDataController::class, 'editOfficer'])->name('masterdata.updateOfficer');
    Route::delete('/masterdata/officer/{id}', [MasterDataController::class, 'deleteOfficer'])->name('masterdata.deleteOfficer');
    Route::get('/masterdata/officer/{id}', [MasterDataController::class, 'getOfficer'])->name('masterdata.getOfficer');
    Route::put('/masterdata/user/{id}', [MasterDataController::class, 'editUser'])->name('masterdata.updateUser');
    Route::delete('/masterdata/user/{id}', [MasterDataController::class, 'deleteUser'])->name('masterdata.deleteUser');
    Route::get('/masterdata/user/{id}', [MasterDataController::class, 'getUser'])->name('masterdata.getUser');
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

    Route::get('/officer-signature-image', [SignatureController::class, 'showOfficer'])->name('officer.signature.image');
    Route::get('/user-signature-image', [SignatureController::class, 'showUser'])->name('user.signature.image');
    // HHMD form submission routes
    Route::post('/submit-hhmd-kedatangan', [HHMDFormController::class, 'store'])->name('submit.hhmd.kedatangan');
    Route::post('/submit-hhmd-hbscp', [HHMDFormController::class, 'store'])->name('submit.hhmd.hbscp');
    Route::post('/submit-hhmd-posbarat', [HHMDFormController::class, 'store'])->name('submit.hhmd.posbarat');
    Route::post('/submit-hhmd-postimur', [HHMDFormController::class, 'store'])->name('submit.hhmd.postimur');
    Route::post('/submit-hhmd-pscpselatan', [HHMDFormController::class, 'store'])->name('submit.hhmd.pscpselatan');
    Route::post('/submit-hhmd-pscputara', [HHMDFormController::class, 'store'])->name('submit.hhmd.pscputara');
});

Route::get('/review/hhmd/{id}', [HHMDFormController::class, 'review'])->name('review.hhmd.reviewhhmd');
Route::get('/pdf/{id}', [HHMDFormController::class, 'generatePDF'])->name('pdf.hhmd');
Route::patch('/hhmd/update-status/{id}', [HHMDFormController::class, 'updateStatus'])->name('hhmd.updateStatus');

Route::post('/hhmd/{id}/save-supervisor-signature', [HHMDFormController::class, 'saveSupervisorSignature'])->name('hhmd.saveSupervisorSignature');
