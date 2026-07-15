@extends('layout.master')

@section('title', 'Tampilan')

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

    /* Theme pill buttons */
    .theme-picker { display: flex; gap: 10px; flex-wrap: wrap; }
    .theme-btn {
        display: flex; align-items: center; gap: 8px;
        padding: 9px 18px; border-radius: 9px; cursor: pointer;
        font-size: 13px; font-weight: 500; font-family: 'DM Sans', sans-serif;
        border: 0.5px solid var(--border); background: var(--bg-secondary);
        color: var(--text-secondary); transition: all 0.15s;
    }
    .theme-btn:hover { background: var(--bg-tertiary); color: var(--text-primary); }
    .theme-btn.selected {
        background: var(--accent-blue-bg); color: var(--accent-blue-txt);
        border-color: var(--accent-blue);
    }
    .theme-preview {
        width: 16px; height: 16px; border-radius: 50%;
        border: 1.5px solid var(--border); flex-shrink: 0;
    }
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
            <div class="settings-section-title">Tampilan Aplikasi</div>
            <div class="settings-section-sub">Pilih tema tampilan yang sesuai preferensi Anda.</div>

            <div class="theme-picker" id="themePicker">
                <button type="button" class="theme-btn" id="btn-light" onclick="setAppearance('light')">
                    <span class="theme-preview" style="background:#fff; border-color:#ccc;"></span>
                    <i class="bi bi-sun"></i> Light
                </button>
                <button type="button" class="theme-btn" id="btn-dark" onclick="setAppearance('dark')">
                    <span class="theme-preview" style="background:#1c1c1a; border-color:#444;"></span>
                    <i class="bi bi-moon"></i> Dark
                </button>
                <button type="button" class="theme-btn" id="btn-system" onclick="setAppearance('system')">
                    <span class="theme-preview" style="background: linear-gradient(135deg, #fff 50%, #1c1c1a 50%); border-color:#888;"></span>
                    <i class="bi bi-display"></i> Sistem
                </button>
            </div>
        </div>
    </div>

</div>

<script>
function setAppearance(value) {
    // Resolve actual theme
    const resolved = value === 'system'
        ? (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light')
        : value;

    document.documentElement.setAttribute('data-theme', resolved);
    localStorage.setItem('theme', value === 'system' ? resolved : value);

    // Update selection state
    document.querySelectorAll('.theme-btn').forEach(b => b.classList.remove('selected'));
    const btn = document.getElementById('btn-' + value);
    if (btn) btn.classList.add('selected');

    // Sync theme icon in topbar if present
    const icon = document.getElementById('themeIcon');
    if (icon) icon.className = resolved === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
}

// Highlight current selection on load
(function() {
    const saved = localStorage.getItem('theme') || 'dark';
    const key = (saved === 'dark' || saved === 'light') ? saved : 'dark';
    const btn = document.getElementById('btn-' + key);
    if (btn) btn.classList.add('selected');
})();
</script>
@endsection
