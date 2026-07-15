@extends('layout.master')

@section('title', 'Edit Siswa')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold">Edit Siswa: {{ $siswa->nama }}</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('siswas.update', $siswa->id) }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" name="nama" value="{{ old('nama', $siswa->nama) }}" class="form-control" placeholder="Full Name" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" id="nis" name="nis" value="{{ old('nis', $siswa->nis) }}" class="form-control" placeholder="Nomor Induk Siswa" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select id="kelas" name="kelas" class="form-select" required>
                                <option value="" disabled>Pilih Kelas</option>
                                <option value="X" {{ old('kelas', $siswa->kelas) == 'X' ? 'selected' : '' }}>X</option>
                                <option value="XI" {{ old('kelas', $siswa->kelas) == 'XI' ? 'selected' : '' }}>XI</option>
                                <option value="XII" {{ old('kelas', $siswa->kelas) == 'XII' ? 'selected' : '' }}>XII</option>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select id="jurusan" name="jurusan" class="form-select" required>
                                <option value="" disabled>Pilih Jurusan</option>
                                <option value="PPLG 1" {{ old('jurusan', $siswa->jurusan) == 'PPLG 1' ? 'selected' : '' }}>PPLG 1</option>
                                <option value="PPLG 2" {{ old('jurusan', $siswa->jurusan) == 'PPLG 2' ? 'selected' : '' }}>PPLG 2</option>
                                <option value="TJKT" {{ old('jurusan', $siswa->jurusan) == 'TJKT' ? 'selected' : '' }}>TJKT</option>
                                <option value="BD 1" {{ old('jurusan', $siswa->jurusan) == 'BD 1' ? 'selected' : '' }}>BD 1</option>
                                <option value="BD 2" {{ old('jurusan', $siswa->jurusan) == 'BD 2' ? 'selected' : '' }}>BD 2</option>
                                <option value="DKV 1" {{ old('jurusan', $siswa->jurusan) == 'DKV 1' ? 'selected' : '' }}>DKV 1</option>
                                <option value="DKV 2" {{ old('jurusan', $siswa->jurusan) == 'DKV 2' ? 'selected' : '' }}>DKV 2</option>
                            </select>
                        </div>
    
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Update Siswa</button>
                            <a href="{{ route('siswas.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
