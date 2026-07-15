@extends('layout.master')

@section('title', 'Edit Peminjaman')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold">Edit Peminjaman #{{ $peminjaman->id }}</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('peminjamans.update', $peminjaman->id) }}" method="POST">
                        @csrf
    
                        <div class="mb-3">
                            <label for="siswa_id" class="form-label">Siswa</label>
                            <select id="siswa_id" name="siswa_id" class="form-select" required>
                                <option value="" disabled>Pilih Siswa</option>
                                @foreach($siswas as $siswa)
                                    <option value="{{ $siswa->id }}" {{ $peminjaman->siswa_id == $siswa->id ? 'selected' : '' }}>
                                        {{ $siswa->nama }} ({{ $siswa->nis }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="buku_id" class="form-label">Buku</label>
                            <select id="buku_id" name="buku_id" class="form-select" required>
                                <option value="" disabled>Pilih Buku</option>
                                @foreach($bukus as $buku)
                                    <option value="{{ $buku->id }}" {{ $peminjaman->buku_id == $buku->id ? 'selected' : '' }}>
                                        {{ $buku->judul }} (Stok: {{ $buku->stok }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_buku" class="form-label">Total Buku Dipinjam</label>
                            <input type="number" id="jumlah_buku" name="jumlah_buku" value="{{ $peminjaman->jumlah_buku ?? 1 }}" class="form-control" min="1" required>
                        </div>
    

    
                        <div class="mb-3">
                            <label for="tanggal_pinjam" class="form-label">Tanggal Pinjam</label>
                            <input type="date" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ $peminjaman->tanggal_pinjam }}" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="tanggal_kembali" class="form-label">Tanggal Kembali</label>
                            <input type="date" id="tanggal_kembali" name="tanggal_kembali" value="{{ $peminjaman->tanggal_kembali }}" class="form-control">
                            <small class="text-muted">Fill only when returned.</small>
                        </div>
    
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select id="status" name="status" class="form-select" required>
                                <option value="dipinjam" {{ $peminjaman->status == 'dipinjam' ? 'selected' : '' }}>Dipinjam</option>
                                <option value="dikembalikan" {{ $peminjaman->status == 'dikembalikan' ? 'selected' : '' }}>Dikembalikan</option>
                                <option value="sebagian dikembalikan" {{ $peminjaman->status == 'sebagian dikembalikan' ? 'selected' : '' }}>Sebagian Dikembalikan</option>
                            </select>
                        </div>
    
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Peminjaman</button>
                            <a href="{{ route('peminjamans.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
