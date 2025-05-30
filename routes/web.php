<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SetController;

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

Route::get('/', [SetController::class, 'index'])->name('dashboard');
Route::get('/form-data', [SetController::class, 'form'])->name('form');
Route::post('/form-data/store', [SetController::class, 'store'])->name('form.store');

Route::get('/admin-magang-dinkopdag', [SetController::class, 'index2'])->name('admin.dashboard');
Route::put('/admin-magang-dinkopdag/update/{id}', [SetController::class, 'upStatus'])->name('admin.upStatus');
Route::put('/admin-magang-dinkopdag/bidangKetua/{id}', [SetController::class, 'updateBidangKetua'])->name('admin.updateBidangKetua');
Route::put('/admin-magang-dinkopdag/bidangAnggota/{id}', [SetController::class, 'updateBidangAnggota'])->name('admin.updateBidangAnggota');
Route::put('/admin-magang-dinkopdag/update_suket/{groupId}', [SetController::class, 'updateSurat'])->name('admin.updateSurat');
Route::delete('/admin-magang-dinkopdag/delete/{id}', [SetController::class, 'destroy'])->name('admin.delete');
Route::get('/admin-magang-dinkopdag/download/{filename}', [SetController::class, 'downloadPdf'])->name('download.pdf');
