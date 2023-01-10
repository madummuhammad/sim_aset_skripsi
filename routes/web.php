<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\TransaksimutasiController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JenisassetController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanmutasiController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PemusnahanController;
use App\Http\Controllers\LaporanpemusnahanController;
use App\Http\Controllers\TransaksipemusnahanController;

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

Route::get('/login',[AuthController::class,'index'])->middleware('guest')->name('login');
Route::post('/login',[AuthController::class,'authenticate']);
Route::post('/logout',[AuthController::class,'logout']);
Route::get('/asset/resultqr/{id_asset}',[AssetController::class,'resultqr']);

Route::middleware('auth')->group(function(){
    Route::get('/',[AssetController::class,'dashboard']);

    // Asset
    Route::get('/asset',[AssetController::class,'index']);
    Route::get('/asset_dimusnahkan',[AssetController::class,'dimusnahkan']);
    Route::get('/asset/create',[AssetController::class,'create']);
    Route::post('/asset/create',[AssetController::class,'store']);
    Route::get('/asset/show/{id_asset}',[AssetController::class,'show']);
    Route::get('/asset/detil/{id_asset}',[AssetController::class,'detail']);
    Route::get('/asset/generateqr/{id_asset}',[AssetController::class,'generateqr']);
    Route::patch('/asset/show/',[AssetController::class,'update']);
    Route::delete('/asset',[AssetController::class,'destroy']);
    // End asset

    // Kategori Asset
    Route::get('/kategori',[KategoriController::class,'index']);
    Route::post('/kategori',[KategoriController::class,'store']);
    Route::delete('/kategori',[KategoriController::class,'destroy']);
    Route::patch('/kategori',[KategoriController::class,'update']);
    // End kategori asset

    // Jenis Asset
    Route::get('/jenis_asset',[JenisassetController::class,'index']);
    Route::post('/jenis_asset',[JenisassetController::class,'store']);
    Route::delete('/jenis_asset',[JenisassetController::class,'destroy']);
    Route::patch('/jenis_asset',[JenisassetController::class,'update']);
    // End jenis asset

    // Lokasi
    Route::get('/lokasi',[LokasiController::class,'index']);
    Route::post('/lokasi',[LokasiController::class,'store']);
    Route::delete('/lokasi',[LokasiController::class,'destroy']);
    Route::patch('/lokasi',[LokasiController::class,'update']);
    // End lokasi

    // Mutasi
    Route::get('/asset/mutasi/{id_mutasi}',[MutasiController::class,'show']);
    Route::post('/asset/mutasi',[MutasiController::class,'store']);
    Route::patch('/asset/mutasi',[MutasiController::class,'update']);
    Route::get('/asset/mutasi',[MutasiController::class,'index']);
    Route::delete('/asset/mutasi',[MutasiController::class,'destroy']);

    // Transaksi Mutasi
    Route::post('/asset/transaksi_mutasi',[TransaksimutasiController::class,'store']);
    Route::patch('/asset/transaksi_mutasi',[TransaksimutasiController::class,'additional']);
    Route::delete('/asset/transaksi_mutasi',[TransaksimutasiController::class,'destroy']);
    // End Transaksi Mutasi

    // Laporan aset
    Route::get('laporan/asset',[AssetController::class,'laporan']);
    Route::get('laporan/asset/pdf',[AssetController::class,'pdf']);
    // End laporan aset

    // Laporan Mutasi
    Route::get('/laporan/mutasi',[LaporanmutasiController::class,'index']);
    Route::patch('/laporan/mutasi',[LaporanmutasiController::class,'update']);
    Route::get('/laporan/mutasi/{id_mutasi}',[LaporanmutasiController::class,'show']);
    Route::get('/laporan/mutasi/pdf/{id_mutasi}',[LaporanmutasiController::class,'pdf']);

    // Pemusnahan
    Route::get('/asset/pemusnahan/{id_pemusnahan}',[PemusnahanController::class,'show']);
    Route::post('/asset/pemusnahan',[PemusnahanController::class,'store']);
    Route::patch('/asset/pemusnahan',[PemusnahanController::class,'update']);
    Route::get('/asset/pemusnahan',[PemusnahanController::class,'index']);
    Route::delete('/asset/pemusnahan',[PemusnahanController::class,'destroy']);
    Route::get('/asset/pemusnahan/bukti/{id_pemusnahan}',[PemusnahanController::class,'bukti']);
    Route::post('/asset/pemusnahan/bukti',[PemusnahanController::class,'create_bukti']);
    Route::post('/asset/pemusnahan/bukti/konfirmasi',[PemusnahanController::class,'create_bukti']);

    // Transaksi Pemusnahan
    Route::post('/asset/transaksi_pemusnahan',[TransaksipemusnahanController::class,'store']);
    Route::delete('/asset/transaksi_pemusnahan',[TransaksipemusnahanController::class,'destroy']);

    // Laporan Pemusnahan
    Route::get('/laporan/pemusnahan',[LaporanpemusnahanController::class,'index']);
    Route::get('/laporan/pemusnahan/{id_pemusnahan}',[LaporanpemusnahanController::class,'show']);
    Route::patch('/laporan/pemusnahan',[LaporanpemusnahanController::class,'update']);
    Route::post('/laporan/pemusnahan/konfirmasi_bukti',[LaporanpemusnahanController::class,'konfirmasi_bukti']);
    Route::get('/laporan/pemusnahan/pdf/{id_pemusnahan}',[LaporanpemusnahanController::class,'pdf']);

    // User
    Route::get('/user',[UserController::class,'index']);
    Route::patch('/user',[UserController::class,'edit_user']);
    Route::get('/user/profile',[UserController::class,'show']);
    Route::patch('/user/profile',[UserController::class,'update']);
    Route::patch('/user/ubah_sandi',[UserController::class,'ubah_sandi']);
    Route::post('/user',[UserController::class,'store']);
    Route::delete('/user',[UserController::class,'destroy']);
    // End user

    // Notifikasi
    Route::get('/notifikasi',[NotifikasiController::class,'index']);
    Route::patch('/notifikasi',[NotifikasiController::class,'update']);





});