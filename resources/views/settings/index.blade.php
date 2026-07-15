@extends('layout.master')

@section('title', 'Pengaturan Sistem')

@section('content')
<style>
    .settings-grid { display: grid; grid-template-columns: 220px 1fr; gap: 20px; align-items: start; }
    .settings-nav-card {
        background: var(--card-bg); border: 0.5px solid var(--border);
        border-radius: 12px; overflow: hidden;
    }
    .settings-nav-header {
        padding: 14px 16px; border-bottom: 0.5px solid var(--border);
        font-size: 11px; font-weight: 600; color: var(--text-tertiary);
        text-transform: uppercase; letter-spacing: 0.08em;
    }
    .settings-nav-list { list-style: none; padding: 8px; }
    .settings-nav-link {
        display: flex; align-items: center; gap: 9px;
        padding: 8px 10px; border-radius: 7px;
        font-size: 13.5px; color: var(--text-secondary);
        transition: background 0.12s, color 0.12s; font-weight: 400;
        text-decoration: none;
    }
    .settings-nav-link i { font-size: 14px; opacity: 0.7; }
    .settings-nav-link:hover { background: var(--bg-secondary); color: var(--text-primary); }
    .settings-nav-link.active {
        background: var(--accent-blue-bg); color: var(--accent-blue-txt);
        font-weight: 500;
    }
    .settings-nav-link.active i { opacity: 1; }

    .settings-card {
        background: var(--card-bg); border: 0.5px solid var(--border);
        border-radius: 12px; overflow: hidden;
    }
    .settings-card-section {
        padding: 20px 24px;
        border-bottom: 0.5px solid var(--border);
    }
    .settings-card-section:last-child { border-bottom: none; }
    .settings-section-title {
        font-size: 14px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px;
    }
    .settings-section-sub {
        font-size: 12.5px; color: var(--text-tertiary); margin-bottom: 18px;
    }
    @media (max-width: 640px) {
        .settings-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="settings-grid">

    {{-- ── Sidebar Nav ── --}}
    <div class="settings-nav-card">
        <div class="settings-nav-header">Pengaturan</div>
        <ul class="settings-nav-list">
            <li>
                <a href="{{ route('settings.index') }}"
                   class="settings-nav-link {{ request()->routeIs('settings.index') ? 'active' : '' }}">
                    <i class="bi bi-sliders"></i> Pengaturan Umum
                </a>
            </li>
            <li>
                <a href="{{ route('settings.profile.edit') }}"
                   class="settings-nav-link {{ request()->routeIs('settings.profile.edit') ? 'active' : '' }}">
                    <i class="bi bi-person"></i> Profil
                </a>
            </li>
            <li>
                <a href="{{ route('settings.password.edit') }}"
                   class="settings-nav-link {{ request()->routeIs('settings.password.edit') ? 'active' : '' }}">
                    <i class="bi bi-shield-lock"></i> Password
                </a>
            </li>
            <li>
                <a href="{{ route('settings.appearance.edit') }}"
                   class="settings-nav-link {{ request()->routeIs('settings.appearance.edit') ? 'active' : '' }}">
                    <i class="bi bi-palette"></i> Tampilan
                </a>
            </li>
        </ul>
    </div>

    {{-- ── Main Content ── --}}
    <div style="display: flex; flex-direction: column; gap: 16px;">

        {{-- Denda Card --}}
        <div class="settings-card">
            <div class="settings-card-section">
                <div class="settings-section-title">Pengaturan Peminjaman</div>
                <div class="settings-section-sub">Konfigurasi aturan dan denda keterlambatan pengembalian buku.</div>

                <form action="{{ route('settings.update') }}" method="POST">
                    @csrf

                    @if (session('success'))
                        <div style="background:var(--accent-green-bg); border:0.5px solid rgba(59,109,17,0.2); border-radius:8px; padding:10px 14px; font-size:12.5px; color:var(--accent-green); margin-bottom:14px;">
                            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                        </div>
                    @endif

                    <div style="margin-bottom:14px;">
                        <label for="denda_per_hari" style="display:block; font-size:12px; font-weight:500; color:var(--text-secondary); margin-bottom:5px;">
                            Denda Keterlambatan Per Hari (Rp)
                        </label>
                        <input type="number"
                               id="denda_per_hari"
                               name="denda_per_hari"
                               style="width:100%; max-width:280px; padding:8px 12px; background:var(--input-bg); border:0.5px solid var(--border); border-radius:8px; color:var(--text-primary); font-size:13px; font-family:'DM Sans',sans-serif; outline:none;"
                               value="{{ old('denda_per_hari', $dendaPerHari) }}"
                               required min="0" step="500">
                        <div style="font-size:11.5px; color:var(--text-tertiary); margin-top:6px;">
                            Nilai ini digunakan otomatis untuk menghitung denda keterlambatan di halaman Peminjaman.
                        </div>
                        @error('denda_per_hari')
                            <div style="color:var(--accent-red); font-size:12px; margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" style="padding:8px 18px; border-radius:8px; border:none; background:var(--accent-blue); color:#fff; font-size:13px; font-weight:500; cursor:pointer; font-family:'DM Sans',sans-serif; transition:opacity 0.12s;">
                        <i class="bi bi-save me-2"></i> Simpan Pengaturan
                    </button>
                </form>
            </div>
        </div>

        {{-- System Info Card --}}
        <div class="settings-card">
            <div class="settings-card-section">
                <div class="settings-section-title">Informasi Sistem</div>
                <div class="settings-section-sub">Detail versi dan environment aplikasi GudangBuku.</div>
                <ul class="list-unstyled mb-0" style="font-size: 13px; color: var(--text-secondary);">
                    <li class="mb-2"><strong style="color:var(--text-primary);">Nama Aplikasi:</strong> GudangBuku</li>
                    <li class="mb-2"><strong style="color:var(--text-primary);">Versi Sistem:</strong> 1.0.0</li>
                    <li class="mb-2"><strong style="color:var(--text-primary);">Terakhir Diperbarui:</strong> {{ date('d M Y') }}</li>
                    <li><strong style="color:var(--text-primary);">Environment:</strong> {{ env('APP_ENV', 'production') }}</li>
                </ul>
            </div>
        </div>

    </div>
</div>

@endsection
