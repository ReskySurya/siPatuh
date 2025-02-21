<?php

use App\Http\Controllers\DailyTestController;
use App\Http\Controllers\HHMDFormController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\WTMDFormController;
use App\Http\Controllers\XRAYFormController;
use App\Http\Controllers\PasswordController;
use Illuminate\Support\Facades\Route;
use App\Models\hhmdsaved;
use App\Models\wtmdsaved;
use App\Models\xraysaved;
use Illuminate\Http\Request;

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
    Route::put('/masterdata/officer/{id}', [MasterDataController::class, 'updateOfficer'])->name('masterdata.updateOfficer');
    Route::delete('/masterdata/officer/{id}', [MasterDataController::class, 'deleteOfficer'])->name('masterdata.deleteOfficer');
    Route::get('/masterdata/officer/{id}', [MasterDataController::class, 'getOfficer'])->name('masterdata.getOfficer');
    Route::put('/masterdata/user/{id}', [MasterDataController::class, 'updateUser'])->name('masterdata.updateUser');
    Route::delete('/masterdata/user/{id}', [MasterDataController::class, 'deleteUser'])->name('masterdata.deleteUser');
    Route::get('/masterdata/user/{id}', [MasterDataController::class, 'getUser'])->name('masterdata.getUser');
    Route::post('/masterdata/user/{id}/reset-password', [MasterDataController::class, 'resetPassword'])
    ->name('masterdata.resetPassword');
    Route::post('/masterdata/officer/{id}/reset-password', [MasterDataController::class, 'resetPassword'])
    ->name('masterdata.resetPassword');
    Route::get('/hhmdform', [DashboardController::class, 'hhmdIndex'])->name('hhmdform');
    Route::get('/wtmd', [DashboardController::class, 'wtmdIndex'])->name('wtmdform');
    Route::get('/xray', [DashboardController::class, 'xrayIndex'])->name('xrayform');
    Route::get('/exportpdf', [PdfController::class, 'index'])->name('exportpdf.index');
});

// Rute Daily Task yang dapat diakses oleh semua pengguna yang sudah login
Route::middleware(['checkrole:superadmin,supervisor,officer'])->group(function () {
    Route::prefix('daily-test')->name('daily-test.')->group(function () {
        // X-ray routes
        Route::get('/xraycabin', [DailyTestController::class, 'xraycabinLayout'])->name('xraycabin');
        Route::get('/xraybagasi', [DailyTestController::class, 'xraybagasiLayout'])->name('xraybagasi');

        // WTMD routes
        Route::get('/wtmd', [DailyTestController::class, 'wtmdLayout'])->name('wtmd');

        // HHMD route
        Route::get('/hhmd', [DailyTestController::class, 'hhmdLayout'])->name('hhmd');
    });

    Route::get('/officer-signature-image', [SignatureController::class, 'showOfficer'])->name('officer.signature.image');
    Route::get('/user-signature-image', [SignatureController::class, 'showUser'])->name('user.signature.image');
    // HHMD form submission routes
    Route::post('/submit-hhmd', [HHMDFormController::class, 'store'])->name('submit.hhmd');
    // XRAY form submission routes
    Route::post('/submit-xray', [XRAYFormController::class, 'store'])->name('submit.xray');
    // WTMD form submission routes
    Route::post('/submit-wtmd', [WTMDFormController::class, 'store'])->name('submit.wtmd');
});

//HHMD Review and PDF Routes
Route::get('/review/hhmd/{id}', [HHMDFormController::class, 'review'])->name('review.hhmd.reviewhhmd');
Route::get('/pdf/{id}', [PdfController::class, 'generatePDF'])->name('pdf.hhmd');
Route::post('/generate-merged-pdf', [PdfController::class, 'generateMergedPDF'])
    ->name('generate.merged.pdf');
Route::patch('/hhmd/update-status/{id}', [HHMDFormController::class, 'updateStatus'])->name('hhmd.updateStatus');

Route::post('/hhmd/{id}/save-supervisor-signature', [HHMDFormController::class, 'saveSupervisorSignature'])->name('hhmd.saveSupervisorSignature');

//WTMD Review and PDF Routes
Route::get('/review/wtmd/{id}', [WTMDFormController::class, 'review'])->name('review.wtmd.reviewwtmd');

Route::patch('/wtmd/update-status/{id}', [WTMDFormController::class, 'updateStatus'])->name('wtmd.updateStatus');

Route::post('/wtmd/{id}/save-supervisor-signature', [WTMDFormController::class, 'saveSupervisorSignature'])->name('wtmd.saveSupervisorSignature');

//XRAY Review and PDF Routes
Route::get('/review/xraybagasi/{id}', [XRAYFormController::class, 'review_bagasi'])->name('review.xray.reviewxraybagasi');
Route::get('/review/xraycabin/{id}', [XRAYFormController::class, 'review_cabin'])->name('review.xray.reviewxraycabin');

Route::patch('/xray/update-status/{id}', [XRAYFormController::class, 'updateStatus'])->name('xray.updateStatus');

Route::post('/xray/{id}/save-supervisor-signature', [XRAYFormController::class, 'saveSupervisorSignature'])->name('xray.saveSupervisorSignature');

Route::post('/filter-hhmd-forms', [DashboardController::class, 'filterByDate'])->name('filter.hhmd.forms');

Route::middleware(['auth:officer'])->group(function () {
    Route::get('/officer/hhmd/create', [HHMDFormController::class, 'create'])->name('officer.hhmd.create');
    Route::get('/officer/hhmd/{id}/edit', [HHMDFormController::class, 'edit'])->name('officer.hhmd.edit');
    Route::put('/officer/hhmd/{id}', [HHMDFormController::class, 'update'])->name('officer.hhmd.update');
});

Route::middleware(['auth:officer'])->group(function () {
    Route::get('/officer/wtmd/create', [WTMDFormController::class, 'create'])->name('officer.wtmd.create');
    Route::get('/officer/wtmd/{id}/edit', [WTMDFormController::class, 'edit'])->name('officer.wtmd.edit');
    Route::put('/officer/wtmd/{id}', [WTMDFormController::class, 'update'])->name('officer.wtmd.update');
});

Route::middleware(['auth:officer'])->group(function () {
    Route::get('/officer/xray/create', [XRAYFormController::class, 'create'])->name('officer.xray.create');
    Route::get('/officer/xraybagasi/{id}/edit', [XRAYFormController::class, 'edit_bagasi'])->name('officer.xray.editbagasi');
    Route::get('/officer/xraycabin/{id}/edit', [XRAYFormController::class, 'edit_cabin'])->name('officer.xray.editcabin');
    Route::put('/officer/xray/{id}', [XRAYFormController::class, 'update'])->name('officer.xray.update');
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

Route::prefix('wtmdform')->group(function () {
    Route::get('/postimur', function(){
        return view('partials.wtmd.postimur');
    })->name('wtmd.postimur');

    Route::get('/pscpselatan', function(){
        return view('partials.wtmd.pscpselatan');
    })->name('wtmd.pscpselatan');

    Route::get('/pscputara', function(){
        return view('partials.wtmd.pscputara');
    })->name('wtmd.pscputara');
});

Route::prefix('xrayform')->group(function () {
    Route::get('/cabinutara', function(){
        return view('partials.xray.cabinutara');
    })->name('xray.cabinutara');
    Route::get('/cabinselatan', function(){
        return view('partials.xray.cabinselatan');
    })->name('xray.cabinselatan');
    Route::get('/bagasibarat', function(){
        return view('partials.xray.bagasibarat');
    })->name('xray.bagasibarat');
    Route::get('/bagasitimur', function(){
        return view('partials.xray.bagasitimur');
    })->name('xray.bagasitimur');
});

Route::get('/hhmdform/kedatangan', [DashboardController::class, 'kedatangan_formCard'])
    ->name('kedatangan.index');

Route::get('/hhmdform/hbscp', [DashboardController::class, 'hbscp_formCard'])->name('hbscp.index');

Route::get('/hhmdform/postimur', [DashboardController::class, 'postimur_formCard'])->name('postimur.index');

Route::get('/hhmdform/posbarat', [DashboardController::class, 'posbarat_formCard'])->name('posbarat.index');

Route::get('/hhmdform/pscputara', [DashboardController::class, 'pscputara_formCard'])->name('pscputara.index');

Route::get('/hhmdform/pscpselatan', [DashboardController::class, 'pscpselatan_formCard'])->name('pscpselatan.index');

// WTMD Routes
Route::get('/wtmd/postimur', [DashboardController::class, 'wtmd_postimur_formCard'])->name('wtmd.postimur');

Route::get('/wtmd/pscpselatan', [DashboardController::class, 'wtmd_pscpselatan_formCard'])->name('wtmd.pscpselatan');

Route::get('/wtmd/pscputara', [DashboardController::class, 'wtmd_pscputara_formCard'])->name('wtmd.pscputara');

// XRAY Routes
Route::get('/xray/cabinutara', [DashboardController::class, 'xray_cabinutara_formCard'])->name('xray.cabinutara');

Route::get('/xray/cabinselatan', [DashboardController::class, 'xray_cabinselatan_formCard'])->name('xray.cabinselatan');

Route::get('/xray/bagasitimur', [DashboardController::class, 'xray_bagasitimur_formCard'])->name('xray.bagasitimur');

Route::get('/xray/bagasibarat', [DashboardController::class, 'xray_bagasibarat_formCard'])->name('xray.bagasibarat');

// PDF Export Routes
Route::middleware(['web'])->group(function () {
    Route::get('/exportpdf', [PdfController::class, 'index'])->name('exportpdf.index');
    Route::get('/preview-pdf-data', [PdfController::class, 'previewData'])->name('preview.pdf.data');
    Route::post('/export-selected-pdf', [PdfController::class, 'exportSelected'])->name('export.selected.pdf');
    Route::post('/export-all-pdf', [PdfController::class, 'exportAll'])->name('export.all.pdf');
});

// Route untuk change password (tanpa check.default.password)
Route::middleware(['auth:web,officer'])->group(function () {
    Route::get('/change-password', [PasswordController::class, 'showChangePasswordForm'])->name('password.change');
    Route::post('/update-password', [PasswordController::class, 'updatePassword'])->name('password.update');
});

// Semua route yang memerlukan autentikasi (dengan check.default.password)
Route::middleware(['auth:web,officer', 'check.default.password'])->group(function () {
    // Dashboard routes
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/officer/dashboard', function () {
        return view('officer.dashboard');
    })->name('officer.dashboard');

    // Masterdata routes
    Route::get('/masterdata', [MasterDataController::class, 'index'])->name('masterdata.index');
    Route::post('/masterdata/add-user', [MasterDataController::class, 'addUser'])->name('masterdata.addUser');
    Route::post('/masterdata/add-officer', [MasterDataController::class, 'addOfficer'])->name('masterdata.addOfficer');
    Route::put('/masterdata/user/{id}', [MasterDataController::class, 'updateUser'])->name('masterdata.updateUser');
    Route::put('/masterdata/officer/{id}', [MasterDataController::class, 'updateOfficer'])->name('masterdata.updateOfficer');
    Route::delete('/masterdata/officer/{id}', [MasterDataController::class, 'deleteOfficer'])->name('masterdata.deleteOfficer');
    Route::delete('/masterdata/user/{id}', [MasterDataController::class, 'deleteUser'])->name('masterdata.deleteUser');
    Route::post('/masterdata/user/{id}/reset-password', [MasterDataController::class, 'resetPassword'])->name('masterdata.resetPassword');
    Route::post('/masterdata/officer/{id}/reset-password', [MasterDataController::class, 'resetPassword'])->name('masterdata.resetPassword');

    // Form routes
    Route::get('/hhmdform', [DashboardController::class, 'hhmdIndex'])->name('hhmdform');
    Route::get('/wtmd', [DashboardController::class, 'wtmdIndex'])->name('wtmdform');
    Route::get('/xray', [DashboardController::class, 'xrayIndex'])->name('xrayform');

    // ... tambahkan route lain yang memerlukan autentikasi ...
});

// Route untuk cek ketersediaan lokasi
Route::get('/check-hhmd-location', function (Request $request) {
    $location = $request->query('location');
    $available = !hhmdsaved::hasSubmittedToday($location);

    $message = $available ? 'Lokasi tersedia' : 'Form untuk lokasi ini sudah dibuat. Silakan tunggu ' .
        ceil((90 - now()->diffInMinutes(hhmdsaved::where('location', $location)
            ->where('status', '!=', 'rejected')
            ->where('submitted_by', auth('officer')->id())
            ->latest()
            ->first()
            ->created_at))) . ' menit lagi';

    return response()->json([
        'available' => $available,
        'message' => $message
    ]);
})->name('check.hhmd.location');

Route::get('/check-wtmd-location', function (Request $request) {
    $location = $request->query('location');
    $available = !wtmdsaved::hasSubmittedToday($location);

    $message = $available ? 'Lokasi tersedia' : 'Form untuk lokasi ini sudah dibuat. Silakan tunggu ' .
        ceil((90 - now()->diffInMinutes(wtmdsaved::where('location', $location)
            ->where('status', '!=', 'rejected')
            ->where('submitted_by', auth('officer')->id())
            ->latest()
            ->first()
            ->created_at))) . ' menit lagi';

    return response()->json([
        'available' => $available,
        'message' => $message
    ]);
})->name('check.wtmd.location');

Route::get('/check-xray-location', function (Request $request) {
    $location = $request->query('location');
    $available = !xraysaved::hasSubmittedToday($location);

    $message = $available ? 'Lokasi tersedia' : 'Form untuk lokasi ini sudah dibuat. Silakan tunggu ' .
        ceil((90 - now()->diffInMinutes(xraysaved::where('location', $location)
            ->where('status', '!=', 'rejected')
            ->where('submitted_by', auth('officer')->id())
            ->latest()
            ->first()
            ->created_at))) . ' menit lagi';

    return response()->json([
        'available' => $available,
        'message' => $message
    ]);
})->name('check.wtmd.location');
