<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    KegiatanController,
    DokumenController,
    GaleriController,
    LaporController

};
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


Route::get('/', [DashboardController::class, 'dashboard'])->name('admin.dashboard');


Route::get('kegiatans', [KegiatanController::class, 'index'])->name('kegiatans.index');
Route::get('kegiatans/create', [KegiatanController::class, 'create'])->name('kegiatans.create');
Route::post('kegiatans', [KegiatanController::class, 'store'])->name('kegiatans.store');
Route::get('kegiatans/{id}', [KegiatanController::class, 'show'])->name('kegiatans.show');
Route::get('kegiatans/{id}/edit', [KegiatanController::class, 'edit'])->name('kegiatans.edit');
Route::put('kegiatans/{id}', [KegiatanController::class, 'update'])->name('kegiatans.update');
Route::delete('kegiatans/{id}', [KegiatanController::class, 'destroy'])->name('kegiatans.destroy');

Route::get('/dokumens', [DokumenController::class, 'index'])->name('dokumens.index');
Route::get('/dokumens/create', [DokumenController::class, 'create'])->name('dokumens.create');
Route::post('/dokumens', [DokumenController::class, 'store'])->name('dokumens.store');
Route::get('/dokumens/{id}', [DokumenController::class, 'show'])->name('dokumens.show');
Route::get('/dokumens/{id}/edit', [DokumenController::class, 'edit'])->name('dokumens.edit');
Route::put('/dokumens/{id}', [DokumenController::class, 'update'])->name('dokumens.update');
Route::delete('/dokumens/{id}', [DokumenController::class, 'destroy'])->name('dokumens.destroy');

Route::get('/galeris', [GaleriController::class, 'index'])->name('galeris.index');
Route::get('/galeris/create', [GaleriController::class, 'create'])->name('galeris.create');
Route::post('/galeris', [GaleriController::class, 'store'])->name('galeris.store');
Route::get('/galeris/{id}', [GaleriController::class, 'show'])->name('galeris.show');
Route::get('/galeris/{id}/edit', [GaleriController::class, 'edit'])->name('galeris.edit');
Route::put('/galeris/{id}', [GaleriController::class, 'update'])->name('galeris.update');
Route::delete('/galeris/{id}', [GaleriController::class, 'destroy'])->name('galeris.destroy');

Route::get('/lapor', [LaporController::class, 'index'])->name('lapor.index');
Route::get('/lapor/create', [LaporController::class, 'create'])->name('lapor.create');
Route::post('/lapor', [LaporController::class, 'store'])->name('lapor.store');
Route::get('/lapor/{id}', [LaporController::class, 'show'])->name('lapor.show');
Route::get('/lapor/{id}/edit', [LaporController::class, 'edit'])->name('lapor.edit');
Route::put('/lapor/{id}', [LaporController::class, 'update'])->name('lapor.update');
Route::delete('/lapor/{id}', [LaporController::class, 'destroy'])->name('lapor.destroy');