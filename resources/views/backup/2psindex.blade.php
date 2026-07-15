@extends('layout.master')

@section('title', 'Daftar Peminjaman')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">Data Peminjaman</h5>
            <div class="d-flex gap-2">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari peminjaman...">
                <a href="{{ route('peminjamans.add') }}" class="btn btn-primary btn-sm text-nowrap">
                    + Tambah Peminjaman
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="text-uppercase small">
                        <tr>
                            <th scope="col" class="px-3 py-3">ID</th>
                            <th scope="col" class="px-3 py-3">Peminjam (Siswa)</th>
                            <th scope="col" class="px-3 py-3">Buku</th>
                            <th scope="col" class="px-3 py-3">Petugas</th>
                            <th scope="col" class="px-3 py-3">Tgl Pinjam</th>
                            <th scope="col" class="px-3 py-3">Tgl Kembali</th>
                            <th scope="col" class="px-3 py-3">Status</th>
                            <th scope="col" class="px-3 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($peminjaman as $p)
                            <tr>
                                <td class="px-3 py-3 fw-medium">
                                    {{ $p->id }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ optional($p->siswa)->nama ?? '-' }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ optional($p->buku)->judul ?? '-' }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ optional($p->user)->name ?? '-' }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $p->tanggal_pinjam }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $p->tanggal_kembali ?? '-' }}
                                </td>
                                <td class="px-3 py-3">
                                    @php
                                        $today = \Carbon\Carbon::today();
                                        $deadline = $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali) : null;
                                        
                                        $statusText = $p->status;
                                        
                                        // Default classes
                                        if ($statusText == 'dipinjam') {
                                            $badgeClass = 'bg-warning text-dark';
                                        } elseif (str_contains(strtolower($statusText), 'terlambat')) {
                                            $badgeClass = 'bg-danger text-white';
                                        } else {
                                            $badgeClass = 'bg-success text-white';
                                        }

                                        // Dynamic check for 'dipinjam' items against deadline
                                        if ($p->status == 'dipinjam' && $deadline) {
                                            if ($today->gt($deadline)) {
                                                $statusText = 'terlambat mengembalikan';
                                                $badgeClass = 'bg-danger text-white';
                                            } elseif ($today->equalTo($deadline)) {
                                                $statusText = 'dikembalikan';
                                                $badgeClass = 'bg-info text-white';
                                            }
                                        }

                                        // Formatting: Replace underscores with spaces and capitalize
                                        $displayStatus = ucwords(str_replace('_', ' ', $statusText));
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">
                                        {{ $displayStatus }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('peminjamans.edit', $p->id) }}" class="text-decoration-none text-primary fw-medium">Edit</a>
                                        <a href="{{ route('peminjamans.delete', $p->id) }}" class="text-decoration-none text-danger fw-medium" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus peminjaman ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-3 py-4 text-center text-muted">
                                    Tidak ada data peminjaman.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
