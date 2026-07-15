@extends('layout.master')

@section('title', 'Pengaturan Profil')

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
    .settings-form-group { margin-bottom: 14px; }
    .settings-label {
        display: block; font-size: 12px; font-weight: 500;
        color: var(--text-secondary); margin-bottom: 5px;
    }
    .settings-input {
        width: 100%; padding: 8px 12px;
        background: var(--input-bg); border: 0.5px solid var(--border);
        border-radius: 8px; color: var(--text-primary);
        font-size: 13px; font-family: 'DM Sans', sans-serif;
        outline: none; transition: border-color 0.12s, box-shadow 0.12s;
    }
    .settings-input:focus {
        border-color: var(--accent-blue);
        box-shadow: 0 0 0 3px rgba(24,95,165,0.12);
    }
    .settings-input::placeholder { color: var(--text-tertiary); }
    .settings-input[disabled] { opacity: 0.5; cursor: not-allowed; }
    .settings-form-note { font-size: 11.5px; color: var(--text-tertiary); margin-top: 4px; }

    .settings-actions { display: flex; align-items: center; gap: 10px; margin-top: 6px; }
    .btn-save {
        padding: 8px 18px; border-radius: 8px; border: none;
        background: var(--accent-blue); color: #fff;
        font-size: 13px; font-weight: 500; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: opacity 0.12s;
    }
    .btn-save:hover { opacity: 0.85; }
    .btn-danger {
        padding: 8px 18px; border-radius: 8px; border: none;
        background: var(--accent-red-bg); color: var(--accent-red);
        border: 0.5px solid rgba(163,45,45,0.25);
        font-size: 13px; font-weight: 500; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: all 0.12s;
    }
    .btn-danger:hover { background: var(--accent-red); color: #fff; }

    /* Delete modal */
    .confirm-overlay {
        display: none; position: fixed; inset: 0; z-index: 1000;
        background: rgba(0,0,0,0.55); backdrop-filter: blur(4px);
        align-items: center; justify-content: center;
    }
    .confirm-overlay.open { display: flex; }
    .confirm-box {
        background: var(--card-bg); border: 0.5px solid var(--border);
        border-radius: 14px; width: min(400px, 92vw); overflow: hidden;
        box-shadow: 0 24px 60px rgba(0,0,0,0.3);
        animation: modalIn 0.22s cubic-bezier(0.22,1,0.36,1) both;
    }
    @keyframes modalIn {
        from { opacity:0; transform: translateY(14px) scale(0.97); }
        to   { opacity:1; transform: translateY(0) scale(1); }
    }
    .confirm-header { padding: 18px 20px 0; }
    .confirm-title { font-size: 15px; font-weight: 700; color: var(--text-primary); }
    .confirm-sub { font-size: 12.5px; color: var(--text-secondary); margin-top: 6px; line-height: 1.6; }
    .confirm-body { padding: 16px 20px; }
    .confirm-footer { padding: 0 20px 18px; display: flex; gap: 8px; justify-content: flex-end; }
    .btn-secondary {
        padding: 8px 16px; border-radius: 8px;
        border: 0.5px solid var(--border); background: var(--bg-secondary);
        color: var(--text-secondary); font-size: 13px; font-weight: 500;
        cursor: pointer; font-family: 'DM Sans', sans-serif;
    }
    .btn-secondary:hover { background: var(--border); }

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

        {{-- Profile Card --}}
        <div class="settings-card">
            <div class="settings-card-section">
                <div class="settings-section-title">Informasi Profil</div>
                <div class="settings-section-sub">Perbarui nama dan alamat email akun Anda.</div>

                <form method="POST" action="{{ route('settings.profile.update') }}">
                    @csrf
                    @method('PUT')

                    @if ($errors->any())
                        <div style="background:var(--accent-red-bg); border:0.5px solid rgba(163,45,45,0.2); border-radius:8px; padding:10px 14px; font-size:12.5px; color:var(--accent-red); margin-bottom:14px;">
                            @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
                        </div>
                    @endif

                    @if (session('status') === 'profile-updated')
                        <div style="background:var(--accent-green-bg); border:0.5px solid rgba(59,109,17,0.2); border-radius:8px; padding:10px 14px; font-size:12.5px; color:var(--accent-green); margin-bottom:14px;">
                            <i class="bi bi-check-circle me-1"></i> Profil berhasil diperbarui.
                        </div>
                    @endif

                    <div class="settings-form-group">
                        <label class="settings-label" for="name">Nama</label>
                        <input type="text" id="name" name="name" class="settings-input"
                               value="{{ old('name', $user->name) }}" required autofocus>
                    </div>
                    <div class="settings-form-group">
                        <label class="settings-label" for="email">Email</label>
                        <input type="email" id="email" name="email" class="settings-input"
                               value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="settings-actions">
                        <button type="submit" class="btn-save">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Delete Account Card --}}
        <div class="settings-card">
            <div class="settings-card-section">
                <div class="settings-section-title" style="color:var(--accent-red);">Hapus Akun</div>
                <div class="settings-section-sub">Hapus akun beserta semua data Anda secara permanen.</div>
                <button type="button" class="btn-danger" onclick="document.getElementById('deleteOverlay').classList.add('open')">
                    <i class="bi bi-trash3 me-1"></i> Hapus Akun
                </button>
            </div>
        </div>

    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div class="confirm-overlay" id="deleteOverlay">
    <div class="confirm-box">
        <div class="confirm-header">
            <div class="confirm-title">Hapus akun Anda?</div>
            <div class="confirm-sub">Tindakan ini tidak dapat dibatalkan. Semua data akun Anda akan dihapus secara permanen. Masukkan kata sandi untuk konfirmasi.</div>
        </div>
        <div class="confirm-body">
            <form method="POST" action="{{ route('settings.profile.destroy') }}" id="deleteForm">
                @csrf
                @method('DELETE')
                <div class="settings-form-group">
                    <label class="settings-label" for="del_password">Kata Sandi</label>
                    <input type="password" id="del_password" name="password" class="settings-input" placeholder="Masukkan kata sandi Anda" required>
                </div>
            </form>
        </div>
        <div class="confirm-footer">
            <button type="button" class="btn-secondary" onclick="document.getElementById('deleteOverlay').classList.remove('open')">Batal</button>
            <button type="submit" form="deleteForm" class="btn-danger">
                <i class="bi bi-trash3 me-1"></i> Ya, Hapus Akun
            </button>
        </div>
    </div>
</div>

<script>
document.getElementById('deleteOverlay').addEventListener('click', function(e) {
    if (e.target === this) this.classList.remove('open');
});
</script>
@endsection
