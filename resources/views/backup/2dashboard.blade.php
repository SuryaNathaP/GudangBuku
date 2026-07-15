@extends('layout.master')

@section('title', 'Dashboard')

@section('content')
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 bg-primary text-white">
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-5">
                    <i class="bi bi-people fs-1 mb-2"></i>
                    <h5 class="card-title">Total Siswa</h5>
                    <h2 class="fw-bold mb-0">{{ \App\Models\Siswa::count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 bg-success text-white">
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-5">
                    <i class="bi bi-book fs-1 mb-2"></i>
                    <h5 class="card-title">Total Buku</h5>
                    <h2 class="fw-bold mb-0">{{ \App\Models\Buku::count() }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 bg-info text-white">
                <div class="card-body d-flex flex-column justify-content-center align-items-center py-5">
                    <i class="bi bi-arrow-left-right fs-1 mb-2"></i>
                    <h5 class="card-title">Peminjaman Aktif</h5>
                    <h2 class="fw-bold mb-0">{{ \App\Models\Peminjaman::where('status', 'dipinjam')->count() }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold">Selamat Datang</h5>
                </div>
                <div class="card-body py-5 text-center">
                    <h3 class="fw-bold">Sistem Informasi Perpustakaan</h3>
                    <p class="text-muted">Gunakan menu di samping untuk mengelola data perpustakaan.</p>
                </div>
            </div>
        </div>
    </div>
@endsection
