@extends('layout.master')

@section('title', 'Daftar Buku')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">Data Buku</h5>
            <div class="d-flex gap-2">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari buku...">
                <a href="{{ route('bukus.add') }}" class="btn btn-primary btn-sm text-nowrap">
                    + Tambah Buku
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="text-uppercase small">
                        <tr>
                            <th scope="col" class="px-3 py-3">No</th>
                            <th scope="col" class="px-3 py-3">Judul</th>
                            <th scope="col" class="px-3 py-3">Penulis</th>
                            <th scope="col" class="px-3 py-3">Tahun</th>
                            <th scope="col" class="px-3 py-3">Kategori</th>
                            <th scope="col" class="px-3 py-3">Stok</th>
                            <th scope="col" class="px-3 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bukus as $index => $bukuItem)
                            <tr>
                                <td class="px-3 py-3 fw-medium">
                                    {{ $index + 1 }}
                                </td>
                                <td class="px-3 py-3 fw-medium">
                                    {{ $bukuItem->judul }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $bukuItem->penulis }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $bukuItem->tahun_terbit }}
                                </td>
                                <td class="px-3 py-3">
                                    <span class="badge bg-primary text-white">
                                        {{ optional($bukuItem->kategori)->nama_kategori ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-3 py-3">
                                    <span class="fw-bold {{ $bukuItem->stok > 0 ? 'text-success' : 'text-danger' }}">
                                        {{ $bukuItem->stok }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('bukus.edit', $bukuItem->id) }}"
                                            class="text-decoration-none text-primary fw-medium">Edit</a>
                                        <a href="{{ route('bukus.delete', $bukuItem->id) }}"
                                            class="text-decoration-none text-danger fw-medium"
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-3 py-4 text-center text-muted">
                                    Tidak ada data buku.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
