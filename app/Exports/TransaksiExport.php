<?php

namespace App\Exports;

use App\Models\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings; // Tambahan agar ada judul kolom
use Maatwebsite\Excel\Concerns\WithMapping; // Tambahan agar data rapi

class TransaksiExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * Mengambil semua data dari database
    */
    public function collection()
    {
        return Transaksi::all();
    }

    /**
    * Mengatur Judul Kolom (Baris Paling Atas di Excel)
    */
    public function headings(): array
    {
        return [
            'ID',
            'Tanggal Transaksi',
            'Nama Pembeli',
            'Nama Barang',
            'Harga (Rp)',
            'Status Pembayaran',
        ];
    }

    /**
    * Memilih kolom mana saja yang mau dimasukkan (Mapping)
    */
    public function map($transaksi): array
    {
        return [
            $transaksi->id,
            $transaksi->created_at->format('d-m-Y H:i'), // Format tanggal cantik
            $transaksi->nama_pembeli,
            $transaksi->nama_barang,
            $transaksi->harga,
            $transaksi->status,
        ];
    }
}