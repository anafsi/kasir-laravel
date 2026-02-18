<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KasirController;

Route::get('/', [KasirController::class, 'index'])->name('home');
Route::post('/simpan', [KasirController::class, 'store'])->name('simpan');
Route::get('/lunas/{id}', [KasirController::class, 'lunas'])->name('lunas');
Route::get('/reset', [KasirController::class, 'reset'])->name('reset');
Route::get('/download-excel', [KasirController::class, 'downloadExcel'])->name('download.excel');
