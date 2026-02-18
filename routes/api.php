<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Jalur 1: Mengambil Data (GET) -> http://ip:8000/api/transaksi
Route::get('/transaksi', [TransaksiController::class, 'index']);

// Jalur 2: Menyimpan Data (POST) -> http://ip:8000/api/transaksi
Route::post('/transaksi', [TransaksiController::class, 'store']);