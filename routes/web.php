<?php

use App\Http\Controllers\AdministrasiController;
use App\Http\Controllers\BagianController;
use App\Http\Controllers\KebutuhanController;
use App\Http\Controllers\PegawaiController;
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

// Route::get('/', function () {
//     return view('layout.template');
// });

// Route::get('/bagian', function () {
//     return view('bagian');
// });

Route::get('/bagian', [BagianController::class, 'GetAllBagian']);
Route::post('/addbagian', [BagianController::class, 'AddBagian']);
Route::post('/updatebagian', [BagianController::class, 'UpdateBagian']);
Route::get('/deletebagian/{id}', [BagianController::class, 'DeleteBagian']);

Route::get('/pegawai', [PegawaiController::class, 'GetAllPegawai']);
Route::post('/addpegawai', [PegawaiController::class, 'AddPegawai']);
Route::post('/updatepegawai', [PegawaiController::class, 'UpdatePegawai']);
Route::get('/deletepegawai/{id}', [PegawaiController::class, 'DeletePegawai']);

Route::get('/kebutuhan', [KebutuhanController::class, 'GetAllKebutuhan']);
Route::post('/addkebutuhan', [KebutuhanController::class, 'AddKebutuhan']);
Route::post('/updatekebutuhan', [KebutuhanController::class, 'UpdateKebutuhan']);
Route::get('/deletekebutuhan/{id}', [KebutuhanController::class, 'DeleteKebutuhan']);

Route::get('/administrasi', [AdministrasiController::class, 'GetAllAdministration']);
Route::post('/addadministrasi', [AdministrasiController::class, 'AddAdministration']);
