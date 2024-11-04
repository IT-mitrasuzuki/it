<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\AsuransiController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\PerizinanController;
use App\Http\Controllers\PerjanjianController;
use App\Http\Controllers\PajakController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WelcomingController;

use Carbon\Carbon;
use Illuminate\Routing\RouteGroup;

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

// Guest Routes (Requires guest to access)
Route::middleware('IsGuest')->group(function(){
    // Login
    Route::get('/', [LoginController::class,'index'])->name('login');
    Route::post('/login-proses', [LoginController::class,'proses_login'])->name('login-proses');
});

// Logged-in Users Routes (Requires authentication to access)
Route::middleware('IsLogin')->group(function(){

    // Dashboard
    Route::get('/dashboard', [WelcomingController::class,'index'])->name('welcome');

    // Logout
    Route::get('/logout', [LoginController::class,'logout'])->name('logout');

    //-------------------------------------------------- Pegawai -----------------------------------------------------------
    Route::resource('pegawai', PegawaiController::class);
    Route::controller(PegawaiController::class)->group(function() {
       
        Route::get('/selectPegawai', 'selectPegawai')->name('pegawai.selectPegawai');
    
        Route::get('/getAutocompleteData', 'getAutocompleteData')->name('pegawai.getAutocompleteData');
    
        Route::get('/searchResponse', 'searchResponse')->name('pegawai.searchResponse');
       
    });
    
    //--------------------------------------------------- Asset -----------------------------------------------------------
    Route::resource('asset', AssetController::class);
    Route::controller(AssetController::class)->group(function() {
    
        Route::get('/get-cari-asset', 'getCari')->name('asset.getCari');

        Route::get('/get-data-asset', 'getData')->name('asset.getData');
       
        Route::get('/cari-asset', 'cari')->name('asset.cari');
    
        Route::get('/laporan-asset', 'laporan_view')->name('asset.laporan');
    
        Route::get('/pegawai_search', 'DataPegawai')->name('search-pegawai');
    
        Route::get('/pegawai_select', 'DataPegawaiSelect')->name('select-pegawai');
    
        Route::get('/asset/pindah/{id}', 'pindah_asset')->name('pindah.asset');
    
        Route::put('/asset/pindah/{id}/edit','pindah_update')->name('pindah.asset.update');
    
        Route::get('/export/asset', 'export')->name('export-asset');
    
        Route::post('/upload-image', 'upload')->name('upload.image');
    
        Route::post('/reset-image', 'resetupload')->name('reset.image');
    
        Route::get('/aset/maintenance', 'maintenance')->name('maintenance');
       
    });
    
    //--------------------------------------------------- Aset -----------------------------------------------------------
    Route::resource('aset', AsetController::class);
    Route::controller(AsetController::class)->group(function() {
    
        Route::get('/get-data/Aset', 'getData')->name('aset.getData');
    
        Route::get('/get-CariAset', 'getCari')->name('aset.getCari');
       
        Route::get('/cari-aset', 'cari')->name('aset.cari');
    
        Route::get('/laporan-aset', 'laporan_view')->name('aset.laporan');
    
        Route::get('/data-aset', 'data_aset')->name('data.aset');
    
        Route::get('/aset/{id}', 'show')->name('show.aset');
    
        Route::get('/aset/{id}/edit', 'edit')->name('edit.aset');
    
        Route::post('/aset/{id}/store', 'store_detail')->name('store.aset');
    
        Route::post('/aset/detail/store','store_detail')->name('store_detail');
    
        Route::delete('/aset/detail/hapus/{id}', 'destroy_detail')->name('destroy_detail');
    
        Route::get('/aset/pindah/{id}', 'pindah_aset')->name('pindah.aset');
    
        Route::put('/aset/pindah/{id}/edit','pindah_update')->name('pindah.update');
    
        Route::get('/export/aset', 'export')->name('export-aset');
    
        Route::get('/aset/form/pdf/{id}', 'FormAsetPDF')->name('export.form-aset');
    
        Route::get('/aset/serah/pdf/{id}', 'SerahAsetPDF')->name('export.serah-aset');
    
        Route::get('/aset/form/view/pdf/{id}', 'FormAsetPDF')->name('export.form-aset.view');
       
    });
    
    //------------------------------------------------- Sewa -----------------------------------------------------
    Route::resource('sewa', SewaController::class);
    Route::controller(SewaController::class)->group(function() {
    
        Route::get('/get-data', 'getData')->name('sewa.getData');
       
        Route::get('/reminder-sewa', 'reminder')->name('sewa.reminder');
    
        Route::get('/export-sewa', 'export')->name('export-sewa');
    
        Route::get('/sewa/mail/{id}', 'sendEmail')->name('mail.sewa');
    
        Route::get('/sewa/viewmail/{id}', 'MailView')->name('mailview.sewa');
    
        Route::post('/sewa/upload-image', 'upload')->name('sewa.upload.image');
    
        Route::post('/sewa/reset-image', 'resetupload')->name('sewa.reset.image');
    
    });
    
    //------------------------------------------------- Izin -----------------------------------------------------
    Route::resource('izin', PerizinanController::class);
    Route::controller(PerizinanController::class)->group(function() {
    
        Route::get('/get-data-izin', 'getData')->name('izin.getData');
       
        Route::get('/reminder-izin', 'reminder')->name('izin.reminder');
    
        Route::get('/export-izin', 'export')->name('export-perizinan');
    
        Route::get('/izin/mail/{id}', 'sendEmail')->name('mail.izin');
    
        Route::get('/izin/viewmail/{id}', 'MailView')->name('mailview.izin');
    
        Route::post('/izin/upload-image', 'upload')->name('izin.upload.image');
    
        Route::post('/izin/reset-image', 'resetupload')->name('izin.reset.image');
       
    });
    
    //------------------------------------------------- Unit -----------------------------------------------------
    Route::resource('unit', UnitController::class);
    Route::controller(UnitController::class)->group(function() {
    
        Route::get('/get-data-unit', 'getData')->name('unit.getData');
       
        Route::get('/reminder-unit', 'reminder')->name('unit.reminder');
    
        Route::get('/export-unit', 'export')->name('export-unit');
    
        Route::get('/unit/mail/{id}', 'sendEmail')->name('mail.unit');
    
        Route::get('/unit/viewmail/{id}', 'MailView')->name('mailview.unit');
    
        Route::post('/unit/upload-image', 'upload')->name('unit.upload.image');
    
        Route::post('/unit/reset-image', 'resetupload')->name('unit.reset.image');
       
    });
    
    //------------------------------------------------- Pajak -----------------------------------------------------
    Route::resource('pajak', PajakController::class);
    Route::controller(PajakController::class)->group(function() {
    
        Route::get('/get-data-pajak', 'getData')->name('pajak.getData');
       
        Route::get('/reminder-pajak', 'reminder')->name('pajak.reminder');
    
        Route::get('/export-pajak', 'export')->name('export-pajak');
    
        Route::get('/pajak/mail/{id}', 'sendEmail')->name('mail.pajak');
    
        Route::get('/pajak/viewmail/{id}', 'MailView')->name('mailview.pajak');
       
    });
    
    //------------------------------------------------ Asuransi -----------------------------------------------------
    Route::resource('asuransi', AsuransiController::class);
    Route::controller(AsuransiController::class)->group(function() {
    
        Route::get('/get-data-asuransi', 'getData')->name('asuransi.getData');
       
        Route::get('/reminder-asuransi', 'reminder')->name('asuransi.reminder');
    
        Route::get('/export-asuransi', 'export')->name('export-asuransi');
    
        Route::get('/asuransi/mail/{id}', 'sendEmail')->name('mail.asuransi');
    
        Route::get('/asuransi/viewmail/{id}', 'MailView')->name('mailview.asuransi');
    
    });
    
    //----------------------------------------------- Perjanjian -----------------------------------------------------
    Route::resource('perjanjian', PerjanjianController::class);
    Route::controller(PerjanjianController::class)->group(function() {
    
        Route::get('/get-data-perjanjian', 'getData')->name('perjanjian.getData');

        Route::get('/perjanjian/{id}/edit', 'edit')->name('edit.perjanjian');
       
        Route::get('/reminder-perjanjian', 'reminder')->name('perjanjian.reminder');
    
        Route::get('/export-perjanjian', 'export')->name('export-perjanjian');
    
        Route::get('/perjanjian/mail/{id}', 'sendEmail')->name('mail.perjanjian');
    
        Route::get('/perjanjian/viewmail/{id}', 'MailView')->name('mailview.perjanjian');
    
    });

});
