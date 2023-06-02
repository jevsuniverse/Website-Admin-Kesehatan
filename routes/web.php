<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\formPasienController;
use App\Http\Controllers\listPasienController;
use App\Http\Controllers\formDiagnosaController;
use App\Http\Controllers\listDiagnosaController;
use App\Http\Controllers\obatController;
use App\Http\Controllers\transaksiController;
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

Auth::routes();

Route::get('/', function () {
    return redirect('/login');
});

Route::middleware(['auth'])->group(function () {
    // Get
    Route::get('/Dashboard', [DashboardController::class, 'index']);
    Route::get('/formPasien', [formPasienController::class, 'index'])->name('form.pasien');
    Route::get('/listPasien', [listPasienController::class, 'index'])->name('list.pasien');
    Route::get('/formDiagnosa', [formDiagnosaController::class, 'index'])->name('form.sesi');
    Route::get('/listDiagnosa', [listDiagnosaController::class, 'index'])->name('list.sesi');
    Route::get('/formObat', [obatController::class, 'index'])->name('form.obat');
    Route::get('/resepObat', [obatController::class, 'resep'])->name('form.resep');
    Route::get('/listDokter', [listPasienController::class, 'dokter'])->name('list.dokter');
    Route::get('/Transaksi', [transaksiController::class, 'index'])->name('form.transaksi');
    Route::get('/listTransaksi', [transaksiController::class, 'datatransaksi'])->name('list.transaksi');
    Route::get('/formPasien/{id}', [formPasienController::class, 'editPasien'])->name('edit.pasien');
    Route::get('/formDokter/{id}', [formPasienController::class, 'editDokter'])->name('edit.dokter');
    Route::get('/formDiagnosa/{id}', [formDiagnosaController::class, 'editSesi'])->name('edit.sesi');
    Route::get('/formTransaksi/{id}', [transaksiController::class, 'editTransaksi'])->name('edit.transaksi');
    Route::get('/listObat', [obatController::class, 'listObat'])->name('obat.list');
    Route::get('/editObat/{id}', [obatController::class, 'editObat'])->name('obat.edit');
    Route::get('/listResepObat', [obatController::class, 'resepList'])->name('resep.list');
    Route::get('/editResepObat/{id}', [obatController::class, 'editResep'])->name('resep.edit');

    // Post
    Route::post('/formPasien/submit', [formPasienController::class, 'store'])->name('form.submit');
    Route::post('/formDiagnosa/submit', [formDiagnosaController::class, 'store'])->name('form.submit.sesi');
    Route::post('/formObat/submit', [obatController::class, 'storeObat'])->name('form.submit.obat');
    Route::post('/formResep/submit', [obatController::class, 'storeResep'])->name('form.submit.resep');
    Route::post('/formTransaksi/submit', [transaksiController::class, 'storeTransaksi'])->name('form.submit.transaksi');

    // Update
    Route::post('/formPasien/e/{id}', [formPasienController::class, 'updatePasien'])->name('update.pasien');
    Route::post('/formDokter/e/{id}', [formPasienController::class, 'updateDokter'])->name('update.dokter');
    Route::post('/formDiagnosa/e/{id}', [formDiagnosaController::class, 'updateSesi'])->name('update.sesi');
    Route::post('/formTransaksi/e/{id}', [transaksiController::class, 'updateTransaksi'])->name('update.transaksi');
    Route::post('/editObat/{id}', [obatController::class, 'updateObat'])->name('obat.update');
    Route::post('/editResep/{id}', [obatController::class, 'updateResep'])->name('resep.update');

    // Destroy
    Route::post('/formPasien/d/{id}', [formPasienController::class, 'deletePasien'])->name('destroy.pasien');
    Route::post('/formDokter/d/{id}', [formPasienController::class, 'deleteDokter'])->name('destroy.dokter');
    Route::post('/formDiagnosa/d/{id}', [formDiagnosaController::class, 'deleteSesi'])->name('destroy.sesi');
    Route::post('/formTransaksi/d/{id}', [transaksiController::class, 'deleteTransaksi'])->name('destroy.transaksi');
    Route::post('/deleteObat/{id}', [obatController::class, 'deleteObat'])->name('destroy.obat');
    Route::post('/deleteResep/{id}', [obatController::class, 'deleteResep'])->name('destroy.resep');
});
