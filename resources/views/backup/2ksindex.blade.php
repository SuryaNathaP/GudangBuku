@extends('layout.master')

@section('title', 'Daftar Kategori')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">Data Kategori</h5>
            <div class="d-flex gap-2">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari kategori...">
                <a href="{{ route('kategoris.add') }}" class="btn btn-primary btn-sm text-nowrap">
                    + Tambah Kategori
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="text-uppercase small">
                        <tr>
                            <th scope="col" class="px-3 py-3">ID</th>
                            <th scope="col" class="px-3 py-3">Nama Kategori</th>
                            <th scope="col" class="px-3 py-3">Keterangan</th>
                            <th scope="col" class="px-3 py-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($kategori as $k)
                            <tr>
                                <td class="px-3 py-3 fw-medium">
                                    {{ $k->id }}
                                </td>
                                <td class="px-3 py-3 fw-medium">
                                    {{ $k->nama_kategori }}
                                </td>
                                <td class="px-3 py-3 text-muted">
                                    {{ Str::limit($k->keterangan, 50) }}
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('kategoris.edit', $k->id) }}" class="text-decoration-none text-primary fw-medium">Edit</a>
                                        <a href="{{ route('kategoris.delete', $k->id) }}" class="text-decoration-none text-danger fw-medium" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">Hapus</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-3 py-4 text-center text-muted">
                                    Tidak ada data kategori.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
