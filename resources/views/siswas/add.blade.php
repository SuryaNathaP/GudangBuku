@extends('layout.master')

@section('title', 'Add Siswa')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold">Add New Siswa</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('siswas.store') }}" method="POST">
                        @csrf
    
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Full Name" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="nis" class="form-label">NIS</label>
                            <input type="text" id="nis" name="nis" class="form-control" placeholder="Nomor Induk Siswa" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Kelas</label>
                            <select id="kelas" name="kelas" class="form-select" required>
                                <option value="" disabled selected>Pilih Kelas</option>
                                <option value="X">X</option>
                                <option value="XI">XI</option>
                                <option value="XII">XII</option>
                            </select>
                        </div>
    
                        <div class="mb-3">
                            <label for="jurusan" class="form-label">Jurusan</label>
                            <select id="jurusan" name="jurusan" class="form-select" required>
                                <option value="" disabled selected>Pilih Jurusan</option>
                                <option value="PPLG 1">PPLG 1</option>
                                <option value="PPLG 2">PPLG 2</option>
                                <option value="TJKT">TJKT</option>
                                <option value="BD 1">BD 1</option>
                                <option value="BD 2">BD 2</option>
                                <option value="DKV 1">DKV 1</option>
                                <option value="DKV 2">DKV 2</option>
                            </select>
                        </div>
    
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Save Siswa</button>
                            <a href="{{ route('siswas.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
