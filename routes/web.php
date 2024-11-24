<?php

use App\Http\Controllers\DailyTestController;
use App\Http\Controllers\HHMDFormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\PdfController;
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
    Route::get('/hhmdform', [DashboardController::class, 'hhmdIndex'])->name('hhmdform');
    Route::get('/wtmd', [DashboardController::class, 'wtmdIndex'])->name('wtmd.index');
    Route::get('/xray', [DashboardController::class, 'xrayIndex'])->name('xray.index');
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

        // HHMD route
        Route::get('/hhmd', [DailyTestController::class, 'hhmdLayout'])->name('hhmd');
    });

    Route::get('/officer-signature-image', [SignatureController::class, 'showOfficer'])->name('officer.signature.image');
    Route::get('/user-signature-image', [SignatureController::class, 'showUser'])->name('user.signature.image');
    // HHMD form submission routes
    Route::post('/submit-hhmd', [HHMDFormController::class, 'store'])->name('submit.hhmd');
});

Route::get('/review/hhmd/{id}', [HHMDFormController::class, 'review'])->name('review.hhmd.reviewhhmd');
Route::get('/pdf/{id}', [PdfController::class, 'generatePDF'])->name('pdf.hhmd');
Route::post('/generate-merged-pdf', [PdfController::class, 'generateMergedPDF'])
    ->name('generate.merged.pdf');
Route::patch('/hhmd/update-status/{id}', [HHMDFormController::class, 'updateStatus'])->name('hhmd.updateStatus');

Route::post('/hhmd/{id}/save-supervisor-signature', [HHMDFormController::class, 'saveSupervisorSignature'])->name('hhmd.saveSupervisorSignature');

Route::post('/filter-hhmd-forms', [DashboardController::class, 'filterByDate'])->name('filter.hhmd.forms');

Route::middleware(['auth:officer'])->group(function () {
    Route::get('/officer/hhmd/create', [HHMDFormController::class, 'create'])->name('officer.hhmd.create');
    Route::get('/officer/hhmd/{id}/edit', [HHMDFormController::class, 'edit'])->name('officer.hhmd.edit');
    Route::put('/officer/hhmd/{id}', [HHMDFormController::class, 'update'])->name('officer.hhmd.update');
});

Route::prefix('hhmdform')->group(function () {
    Route::get('/hbscp', function () {
        return view('partials.hbscp');
    })->name('hbscp.index');
    Route::get('/poskedatangan', function() {
        return view('partials.kedatangan');
    })->name('kedatangan.index');
    Route::get('/postimur', function(){
        return view('partials.postimur');
    })->name('postimur.index');
    Route::get('/posbarat', function(){
        return view('partials.posbarat');
    })->name('posbarat.index');
    Route::get('/pscpselatan', function(){
        return view('partials.pscpselatan');
    })->name('pscpselatan.index');
    Route::get('/pscputara', function(){
        return view('partials.pscputara');
    })->name('pscputara.index');
});

Route::get('/hhmdform/kedatangan', [DashboardController::class, 'kedatangan_formCard'])->name('kedatangan.index');
Route::post('/hhmdform/kedatangan/filter', [DashboardController::class, 'filterKedatangan_FormCardByDate'])->name('filter.kedatangan.forms');

Route::get('/hhmdform/hbscp', [DashboardController::class, 'hbscp_formCard'])->name('hbscp.index');
Route::post('/hhmdform/hbscp/filter', [DashboardController::class, 'filterhbscp_FormCardByDate'])->name('filter.hbscp.forms');

Route::get('/hhmdform/postimur', [DashboardController::class, 'postimur_formCard'])->name('postimur.index');
Route::post('/hhmdform/postimur/filter', [DashboardController::class, 'filterpostimur_FormCardByDate'])->name('filter.postimur.forms');

Route::get('/hhmdform/posbarat', [DashboardController::class, 'posbarat_formCard'])->name('posbarat.index');
Route::post('/hhmdform/posbarat/filter', [DashboardController::class, 'filterposbarat_FormCardByDate'])->name('filter.posbarat.forms');

Route::get('/hhmdform/pscputara', [DashboardController::class, 'pscputara_formCard'])->name('pscputara.index');
Route::post('/hhmdform/pscputara/filter', [DashboardController::class, 'filterpscputara_FormCardByDate'])->name('filter.pscputara.forms');

Route::get('/hhmdform/pscpselatan', [DashboardController::class, 'pscpselatan_formCard'])->name('pscpselatan.index');
Route::post('/hhmdform/pscpselatan/filter', [DashboardController::class, 'filterpscpselatan_FormCardByDate'])->name('filter.pscpselatan.forms');
