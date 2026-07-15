@extends('layout.master')

@section('title', 'Tambah Kategori')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold">Tambah Kategori Baru</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('kategoris.store') }}" method="POST">
                        @csrf
    


                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <textarea id="keterangan" name="keterangan" rows="4" class="form-control" required></textarea>
                        </div>
    
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                            <a href="{{ route('kategoris.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
