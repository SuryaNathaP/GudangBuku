@extends('layout.master')

@section('title', 'Ubah Password')

@section('content')
<style>
    .settings-grid { display: grid; grid-template-columns: 220px 1fr; gap: 20px; align-items: start; }
    .settings-nav-card { background: var(--card-bg); border: 0.5px solid var(--border); border-radius: 12px; overflow: hidden; }
    .settings-nav-header { padding: 14px 16px; border-bottom: 0.5px solid var(--border); font-size: 11px; font-weight: 600; color: var(--text-tertiary); text-transform: uppercase; letter-spacing: 0.08em; }
    .settings-nav-list { list-style: none; padding: 8px; }
    .settings-nav-link { display: flex; align-items: center; gap: 9px; padding: 8px 10px; border-radius: 7px; font-size: 13.5px; color: var(--text-secondary); transition: background 0.12s, color 0.12s; font-weight: 400; text-decoration: none; }
    .settings-nav-link i { font-size: 14px; opacity: 0.7; }
    .settings-nav-link:hover { background: var(--bg-secondary); color: var(--text-primary); }
    .settings-nav-link.active { background: var(--accent-blue-bg); color: var(--accent-blue-txt); font-weight: 500; }
    .settings-nav-link.active i { opacity: 1; }
    .settings-card { background: var(--card-bg); border: 0.5px solid var(--border); border-radius: 12px; overflow: hidden; }
    .settings-card-section { padding: 20px 24px; }
    .settings-section-title { font-size: 14px; font-weight: 600; color: var(--text-primary); margin-bottom: 2px; }
    .settings-section-sub { font-size: 12.5px; color: var(--text-tertiary); margin-bottom: 18px; }
    .settings-form-group { margin-bottom: 14px; }
    .settings-label { display: block; font-size: 12px; font-weight: 500; color: var(--text-secondary); margin-bottom: 5px; }
    .settings-input { width: 100%; padding: 8px 12px; background: var(--input-bg); border: 0.5px solid var(--border); border-radius: 8px; color: var(--text-primary); font-size: 13px; font-family: 'DM Sans', sans-serif; outline: none; transition: border-color 0.12s, box-shadow 0.12s; }
    .settings-input:focus { border-color: var(--accent-blue); box-shadow: 0 0 0 3px rgba(24,95,165,0.12); }
    .settings-input::placeholder { color: var(--text-tertiary); }
    .btn-save { padding: 8px 18px; border-radius: 8px; border: none; background: var(--accent-blue); color: #fff; font-size: 13px; font-weight: 500; cursor: pointer; font-family: 'DM Sans', sans-serif; transition: opacity 0.12s; }
    .btn-save:hover { opacity: 0.85; }
    @media (max-width: 640px) { .settings-grid { grid-template-columns: 1fr; } }
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
    <div class="settings-card">
        <div class="settings-card-section">
            <div class="settings-section-title">Ubah Password</div>
            <div class="settings-section-sub">Pastikan akun Anda menggunakan password yang kuat dan aman.</div>

            <form method="POST" action="{{ route('settings.password.update') }}">
                @csrf
                @method('PUT')

                @if ($errors->any())
                    <div style="background:var(--accent-red-bg); border:0.5px solid rgba(163,45,45,0.2); border-radius:8px; padding:10px 14px; font-size:12.5px; color:var(--accent-red); margin-bottom:14px;">
                        @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
                    </div>
                @endif

                @if (session('status') === 'password-updated')
                    <div style="background:var(--accent-green-bg); border:0.5px solid rgba(59,109,17,0.2); border-radius:8px; padding:10px 14px; font-size:12.5px; color:var(--accent-green); margin-bottom:14px;">
                        <i class="bi bi-check-circle me-1"></i> Password berhasil diperbarui.
                    </div>
                @endif

                <div class="settings-form-group">
                    <label class="settings-label" for="current_password">Password Saat Ini</label>
                    <input type="password" id="current_password" name="current_password"
                           class="settings-input" required autocomplete="current-password">
                </div>
                <div class="settings-form-group">
                    <label class="settings-label" for="password">Password Baru</label>
                    <input type="password" id="password" name="password"
                           class="settings-input" required autocomplete="new-password">
                </div>
                <div class="settings-form-group">
                    <label class="settings-label" for="password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                           class="settings-input" required autocomplete="new-password">
                </div>

                <button type="submit" class="btn-save">Simpan Password</button>
            </form>
        </div>
    </div>

</div>
@endsection
