<?php

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resources([
    'master/dokter' => App\Http\Controllers\Master\DokterController::class,
    'master/obat' => App\Http\Controllers\Master\ObatController::class,
    'master/pasien' => App\Http\Controllers\Master\PasienController::class,
    'transaksi/daftar_pasien_baru' => App\Http\Controllers\Transaksi\DaftarPasienBaruController::class,
    'transaksi/kunjungan' => App\Http\Controllers\Transaksi\KunjunganController::class,
    'transaksi/rekam_medis' => App\Http\Controllers\Transaksi\RekamMedisController::class,
    'transaksi/resep_obat' => App\Http\Controllers\Transaksi\ResepObatController::class,
    'transaksi/pembayaran' => App\Http\Controllers\Transaksi\PembayaranController::class,
]);

Route::post('transaksi/rekam_medis_detail' , [App\Http\Controllers\Transaksi\RekamMedisController::class, 'storeRekamMedis']);
Route::delete('transaksi/rekam_medis_detail/{id}' , [App\Http\Controllers\Transaksi\RekamMedisController::class, 'deleteRekamMedis']);
Route::get('transaksi/rekam_medis/{id}/view' , [App\Http\Controllers\Transaksi\RekamMedisController::class, 'viewRekamMedis']);

Route::post('transaksi/resep_obat_detail' , [App\Http\Controllers\Transaksi\ResepObatController::class, 'storeResepObat']);
Route::delete('transaksi/resep_obat_detail/{id}' , [App\Http\Controllers\Transaksi\ResepObatController::class, 'deleteResepObat']);

Route::put('status/pembayaran/{id}', [App\Http\Controllers\Transaksi\PembayaranController::class, 'update']);