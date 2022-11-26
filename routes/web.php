<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{SiswaController, MapelController,
    KelasController,TahunPelajaranController,NilaiHarianController, DetailKelasController, NilaiController
, KelasSiswaController};
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

Route::get('/', function () {
    return view('auth.login');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => 'admin'], function () {
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/mapel', MapelController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/tahunpelajaran', TahunPelajaranController::class);
    Route::resource('/nilai_harian', NilaiHarianController::class);
    Route::resource('/detailkelas', DetailKelasController::class);
    Route::resource('/nilai', NilaiController::class);
    Route::resource('/kelas_siswa', KelasSiswaController::class);


});



Route::get('changeStatus', 'GuruController@changeStatus');

