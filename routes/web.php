<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\TransaksimutasiController;
use App\Http\Controllers\AssetController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\JenisassetController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanmutasiController;

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
    Route::get('/', function () {
        $data['jml_asset']=AssetController::jml_asset();
        return view('dashboard',$data);
    });

    // Asset
    Route::get('/asset',[AssetController::class,'index']);
    Route::get('/asset/create',[AssetController::class,'create']);
    Route::post('/asset/create',[AssetController::class,'store']);
    Route::get('/asset/show/{id_asset}',[AssetController::class,'show']);
    Route::get('/asset/detil/{id_asset}',[AssetController::class,'edit']);
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
    Route::delete('/asset/transaksi_mutasi',[TransaksimutasiController::class,'destroy']);
    // End Mutasi

    // Laporan Mutasi
    Route::get('/laporan/mutasi',[LaporanmutasiController::class,'index']);
    Route::patch('/laporan/mutasi',[LaporanmutasiController::class,'update']);
    Route::get('/laporan/mutasi/{id_mutasi}',[LaporanmutasiController::class,'show']);
    Route::get('/laporan/mutasi/pdf/{id_mutasi}',[LaporanmutasiController::class,'pdf']);

    // User
    Route::get('/user',[UserController::class,'index']);
    Route::patch('/user',[UserController::class,'edit_user']);
    Route::get('/user/profile',[UserController::class,'show']);
    Route::patch('/user/profile',[UserController::class,'update']);
    Route::post('/user',[UserController::class,'store']);
    // End user



    

});






