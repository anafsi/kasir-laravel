<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Pastikan ini sesuai dengan nama tabel di database Anda (biasanya plural/jamak)
    // Jika nama tabel Anda 'transaksis', baris ini tidak wajib. 
    // Tapi ditulis saja biar aman.
    protected $table = 'transaksis';

    // DAFTAR KOLOM YANG BOLEH DIISI (Mass Assignment)
    protected $fillable = [
        'nama_pembeli',
        'nama_barang',
        'harga',
        'status',
    ];
}