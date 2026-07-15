@extends('layout.master')

@section('title', 'Edit Kategori')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold">Edit Kategori: {{ $kategori->nama_kategori }}</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('kategoris.update', $kategori->id) }}" method="POST">
                        @csrf
    
                        <div class="mb-3">
                            <label for="id" class="form-label">ID (Read Only)</label>
                            <input type="text" id="id" name="id" value="{{ $kategori->id }}" class="form-control" readonly disabled>
                        </div>
    
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" id="nama_kategori" name="nama_kategori" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" rows="4" class="form-control" required>{{ old('keterangan', $kategori->keterangan) }}</textarea>
                        </div>
    
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Kategori</button>
                            <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
