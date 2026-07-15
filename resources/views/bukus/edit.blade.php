@extends('layout.master')

@section('title', 'Edit Buku')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold">Edit Buku: {{ $buku->judul }}</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('bukus.update', $buku->id) }}" method="POST">
                        @csrf
    
                        <div class="mb-3">
                            <label for="id" class="form-label">ID (Read Only)</label>
                            <input type="text" id="id" name="id" value="{{ $buku->id }}" class="form-control" readonly disabled>
                        </div>
    
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul Buku</label>
                            <input type="text" id="judul" name="judul" value="{{ old('judul', $buku->judul) }}" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="penulis" class="form-label">Penulis</label>
                            <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $buku->penulis) }}" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                            <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit) }}" min="1900" max="{{ date('Y') }}" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="kategori_id" class="form-label">Kategori</label>
                            <select id="kategori_id" name="kategori_id" class="form-select" required>
                                <option value="" disabled>Pilih Kategori</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ (old('kategori_id', $buku->kategori_id) == $kategori->id) ? 'selected' : '' }}>
                                        {{ $kategori->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                         <div class="mb-3">
                            <label for="stok" class="form-label">Stok</label>
                            <input type="number" id="stok" name="stok" value="{{ old('stok', $buku->stok) }}" min="0" class="form-control" required>
                        </div>

                         <div class="mb-3">
                            <label for="rak" class="form-label">Rak Buku</label>
                            <select id="rak" name="rak" class="form-select" required>
                                <option value="" disabled>Pilih Rak</option>
                                <option value="Rak 1" {{ old('rak', $buku->rak) == 'Rak 1' ? 'selected' : '' }}>Rak 1</option>
                                <option value="Rak 2" {{ old('rak', $buku->rak) == 'Rak 2' ? 'selected' : '' }}>Rak 2</option>
                                <option value="Rak 3" {{ old('rak', $buku->rak) == 'Rak 3' ? 'selected' : '' }}>Rak 3</option>
                                <option value="Rak 4" {{ old('rak', $buku->rak) == 'Rak 4' ? 'selected' : '' }}>Rak 4</option>
                            </select>
                        </div>
    
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Buku</button>
                            <a href="{{ route('bukus.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
