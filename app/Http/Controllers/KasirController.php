<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi; // Panggil Model

class KasirController extends Controller
{
    public function index()
    {
        // Ambil Data Dashboard
        $total_uang = Transaksi::where('status', 'Lunas')->sum('harga');
        $total_hutang = Transaksi::where('status', 'Hutang')->sum('harga');
        
        // Ambil Rekap Barang (Group By)
        $rekap = Transaksi::select('nama_barang', \DB::raw('count(*) as jumlah'))
                 ->groupBy('nama_barang')
                 ->orderBy('jumlah', 'desc')
                 ->get();

        // Ambil Riwayat Lunas (Terbaru)
        $riwayat_lunas = Transaksi::where('status', 'Lunas')->latest()->limit(10)->get();
        
        // Ambil Riwayat Hutang
        $riwayat_hutang = Transaksi::where('status', 'Hutang')->latest()->get();

        return view('kasir', compact('total_uang', 'total_hutang', 'rekap', 'riwayat_lunas', 'riwayat_hutang'));
    }

    public function store(Request $request)
    {
        // Pecah Barang|Harga
        $barang_info = explode('|', $request->barang);
        
        Transaksi::create([
            'nama_barang' => $barang_info[0],
            'harga' => $barang_info[1],
            'nama_pembeli' => $request->nama_pembeli,
            'status' => $request->status
        ]);

        return back()->with('success', 'Transaksi berhasil disimpan!');
    }

    public function lunas($id)
    {
        Transaksi::find($id)->update(['status' => 'Lunas']);
        return back()->with('success', 'Hutang berhasil dilunasi!');
    }

    public function reset()
    {
        Transaksi::truncate(); // Hapus semua data
        return back()->with('warning', 'Semua data telah di-reset!');
    }
}