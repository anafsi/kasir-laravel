<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir Laravel</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        .card { border: none; border-radius: 15px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .card-header { border-radius: 15px 15px 0 0 !important; font-weight: 600; }
        .clock-card { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; }
    </style>
</head>
<body class="p-4">

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-4 mb-4 d-flex flex-column">
            <div class="card clock-card mb-4 text-center p-3 shadow-lg">
                <h2 id="jam" class="fw-bold mb-0">00:00:00</h2>
                <small id="tanggal" class="text-white-50">Loading...</small>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white py-3">
                    <i class="bi bi-cart-plus-fill text-primary"></i> Input Transaksi
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('simpan') }}">
                        @csrf 
                        <div class="mb-3">
                            <label class="form-label small text-muted">Pilih Barang</label>
                            <select name="barang" class="form-select" required>
                                <option value="" disabled selected>-- Pilih Menu --</option>
                                <option value="Astor|8000">Astor (Rp. 8.000)</option>
                                <option value="Astor (2)|15000">Astor 2 Pcs (Rp. 15.000)</option>
                                <option value="Roti|4000">Roti (Rp. 4.000)</option>
                                <option value="Roti (3)|10000">Roti 3 Pcs (Rp. 10.000)</option>
                                <option value="Popcorn|5000">Popcorn (Rp. 5.000)</option>
                                <option value="Sakura|5000">Sakura (Rp. 5.000)</option>
                                <option value="Sosreng|5000">Sosreng (Rp. 5.000)</option>
                                <option value="Rambak|5000">Rambak (Rp. 5.000)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-muted">Nama Pembeli</label>
                            <input type="text" name="nama_pembeli" class="form-control" placeholder="Cth: Budi" autocomplete="off" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small text-muted">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Lunas">🟢 Lunas</option>
                                <option value="Hutang">🔴 Hutang</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Simpan Data</button>
                    </form>
                </div>
            </div>

            <div class="mt-auto">
                <button onclick="konfirmasiReset()" class="btn btn-outline-danger w-100">
                    <i class="bi bi-trash3-fill"></i> Reset Semua Data
                </button>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="row mb-4">
                <div class="col-md-6">
                    <div class="card bg-success text-white h-100 p-3">
                        <h6>Total Uang Masuk</h6>
                        <h3 class="fw-bold">Rp. {{ number_format($total_uang, 0, ',', '.') }}</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card bg-danger text-white h-100 p-3">
                        <h6>Total Piutang</h6>
                        <h3 class="fw-bold">Rp. {{ number_format($total_hutang, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header bg-white">Barang Terjual Hari Ini</div>
                <div class="card-body p-0">
                    <table class="table table-hover table-striped mb-0 text-center">
                        <thead class="table-dark"><tr><th>Nama Barang</th><th>Total Terjual</th></tr></thead>
                        <tbody>
                            @forelse($rekap as $r)
                            <tr>
                                <td class="text-start ps-4">{{ $r->nama_barang }}</td>
                                <td><span class="badge bg-secondary">{{ $r->jumlah }} Pcs</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="2" class="text-muted py-3">Belum ada transaksi</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header bg-success text-white">Riwayat LUNAS</div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="table-light"><tr><th>Nama</th><th>Barang</th><th class="text-end">Jam</th></tr></thead>
                                <tbody>
                                    @foreach($riwayat_lunas as $r)
                                    <tr>
                                        <td class="fw-bold text-success">{{ $r->nama_pembeli }}</td>
                                        <td>{{ $r->nama_barang }}</td>
                                        <td class="text-end text-muted">{{ $r->created_at->format('H:i') }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 border-danger">
                        <div class="card-header bg-danger text-white">Riwayat HUTANG</div>
                        <div class="card-body p-0">
                            <table class="table table-sm table-hover mb-0">
                                <thead class="table-light"><tr><th>Nama</th><th>Barang</th><th>Jam</th><th class="text-center">Aksi</th></tr></thead>
                                <tbody>
                                    @foreach($riwayat_hutang as $r)
                                    <tr>
                                        <td class="fw-bold text-danger">{{ $r->nama_pembeli }}</td>
                                        <td>{{ $r->nama_barang }}</td>
                                        <td class="text-muted small">{{ $r->created_at->format('H:i') }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('lunas', $r->id) }}" class="btn btn-success btn-sm" onclick="return confirm('Lunasi hutang ini?')">
                                                <i class="bi bi-check-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateClock() {
        var now = new Date();
        document.getElementById('jam').innerText = now.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit', second: '2-digit' }).replace(/\./g, ':');
        document.getElementById('tanggal').innerText = now.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
    }
    setInterval(updateClock, 1000); updateClock();

    function konfirmasiReset() {
        Swal.fire({
            title: 'Hapus SEMUA Data?', text: "Data tidak bisa kembali!", icon: 'warning',
            showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, Reset!'
        }).then((result) => {
            if (result.isConfirmed) window.location.href = "{{ route('reset') }}";
        })
    }

    // Notifikasi SweetAlert dari Session Laravel
    @if(session('success'))
        Swal.fire({icon: 'success', title: 'Berhasil', text: '{{ session('success') }}', timer: 1500, showConfirmButton: false});
    @endif
    @if(session('warning'))
        Swal.fire({icon: 'warning', title: 'Reset', text: '{{ session('warning') }}', timer: 1500, showConfirmButton: false});
    @endif
</script>
</body>
</html>