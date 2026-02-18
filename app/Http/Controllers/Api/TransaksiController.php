<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * index
     * Mengambil semua data transaksi dari database
     * Method: GET
     */
    public function index()
    {
        // Ambil data terbaru (latest) supaya yang baru input muncul di atas
        $transaksis = Transaksi::latest()->get();

        // Kembalikan dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data Transaksi',
            'data'    => $transaksis
        ], 200);
    }

    /**
     * store
     * Menyimpan data baru ke database
     * Method: POST
     */
    public function store(Request $request)
    {
        // Validasi data (Opsional, tapi bagus untuk keamanan)
        // Pastikan data yang dikirim tidak kosong
        if(!$request->nama_pembeli || !$request->nama_barang) {
             return response()->json([
                'success' => false,
                'message' => 'Nama Pembeli atau Barang tidak boleh kosong!',
            ], 400);
        }

        // Proses Simpan ke Database
        $transaksi = Transaksi::create([
            'nama_pembeli' => $request->nama_pembeli,
            'nama_barang'  => $request->nama_barang,
            'harga'        => $request->harga,
            'status'       => $request->status,
        ]);

        // Cek apakah berhasil disimpan
        if($transaksi) {
            return response()->json([
                'success' => true,
                'message' => 'Transaksi Berhasil Disimpan!',
                'data'    => $transaksi
            ], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Transaksi Gagal Disimpan!',
            ], 409);
        }
    }
}