<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | Perpustakaan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <script>
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>

    <style>
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f5f5f3;
            --bg-tertiary: #efefec;
            --text-primary: #1a1a18;
            --text-secondary: #6b6b68;
            --text-tertiary: #9b9b97;
            --border-color: rgba(0,0,0,0.08);
            --border-hover: rgba(0,0,0,0.16);
            --sidebar-bg: #111110;
            --sidebar-text: #e8e8e4;
            --sidebar-muted: #6b6b68;
            --sidebar-active-bg: #185FA5;
            --sidebar-active-text: #ffffff;
            --sidebar-hover-bg: rgba(255,255,255,0.06);
            --accent-blue: #185FA5;
            --accent-blue-light: #E6F1FB;
            --accent-teal: #0F6E56;
            --accent-teal-light: #E1F5EE;
            --accent-amber: #854F0B;
            --accent-amber-light: #FAEEDA;
            --topbar-bg: #ffffff;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.04), 0 0 0 0.5px rgba(0,0,0,0.06);
            --radius-md: 8px;
            --radius-lg: 12px;
            --font-sans: 'DM Sans', system-ui, -apple-system, sans-serif;
        }

        [data-theme="dark"] {
            --bg-primary: #1c1c1a;
            --bg-secondary: #242422;
            --bg-tertiary: #141413;
            --text-primary: #e8e8e4;
            --text-secondary: #9b9b97;
            --text-tertiary: #6b6b68;
            --border-color: rgba(255,255,255,0.08);
            --border-hover: rgba(255,255,255,0.14);
            --sidebar-bg: #0d0d0c;
            --topbar-bg: #1c1c1a;
            --shadow-sm: 0 1px 2px rgba(0,0,0,0.2), 0 0 0 0.5px rgba(255,255,255,0.04);
            --accent-blue-light: rgba(24,95,165,0.15);
            --accent-teal-light: rgba(15,110,86,0.15);
            --accent-amber-light: rgba(133,79,11,0.15);
        }

        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: var(--font-sans);
            background: var(--bg-tertiary);
            color: var(--text-primary);
            font-size: 14px;
            line-height: 1.5;
            transition: background 0.2s, color 0.2s;
        }

        a { text-decoration: none; }

        /* ── Layout ── */
        .app-layout {
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 220px;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            flex-shrink: 0;
            transition: width 0.2s;
        }

        .sidebar-brand {
            padding: 20px 16px 14px;
            border-bottom: 0.5px solid rgba(255,255,255,0.07);
        }

        .brand-name {
            font-size: 15px;
            font-weight: 600;
            color: var(--sidebar-text);
            letter-spacing: -0.01em;
        }

        .brand-sub {
            font-size: 10px;
            color: var(--sidebar-muted);
            text-transform: uppercase;
            letter-spacing: 0.07em;
            margin-top: 2px;
        }

        .sidebar-nav {
            flex: 1;
            padding: 12px 10px;
            list-style: none;
        }

        .nav-section-label {
            font-size: 9.5px;
            color: var(--sidebar-muted);
            text-transform: uppercase;
            letter-spacing: 0.09em;
            padding: 10px 8px 4px;
            display: block;
        }

        .nav-link-item {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 7px 10px;
            border-radius: var(--radius-md);
            color: rgba(232,232,228,0.65);
            font-size: 13px;
            transition: background 0.15s, color 0.15s;
            margin-bottom: 1px;
        }

        .nav-link-item:hover {
            background: var(--sidebar-hover-bg);
            color: var(--sidebar-text);
        }

        .nav-link-item.active {
            background: var(--sidebar-active-bg);
            color: var(--sidebar-active-text);
        }

        .nav-link-item i {
            font-size: 14px;
            flex-shrink: 0;
            opacity: 0.8;
        }

        .nav-link-item.active i { opacity: 1; }

        .sidebar-footer {
            padding: 12px 14px;
            border-top: 0.5px solid rgba(255,255,255,0.07);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .sidebar-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--accent-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: 12px;
            font-weight: 500;
            color: var(--sidebar-text);
        }

        .sidebar-user-role {
            font-size: 10px;
            color: var(--sidebar-muted);
        }

        /* ── Main ── */
        .main-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* ── Topbar ── */
        .topbar {
            background: var(--topbar-bg);
            border-bottom: 0.5px solid var(--border-color);
            padding: 0 24px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            transition: background 0.2s;
        }

        .topbar-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .mobile-toggle {
            display: none;
            border: 0.5px solid var(--border-color);
            background: var(--bg-secondary);
            color: var(--text-secondary);
            border-radius: var(--radius-md);
            padding: 5px 8px;
            cursor: pointer;
            font-size: 15px;
            line-height: 1;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .topbar-breadcrumb {
            font-size: 11px;
            color: var(--text-tertiary);
        }

        .topbar-breadcrumb span {
            color: var(--text-primary);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .icon-btn {
            width: 32px;
            height: 32px;
            border-radius: var(--radius-md);
            background: var(--bg-secondary);
            border: 0.5px solid var(--border-color);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 14px;
            transition: background 0.15s, border-color 0.15s;
        }

        .icon-btn:hover {
            background: var(--bg-tertiary);
            border-color: var(--border-hover);
            color: var(--text-primary);
        }

        /* User dropdown */
        .user-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 10px 4px 4px;
            border-radius: var(--radius-md);
            border: 0.5px solid var(--border-color);
            background: var(--bg-secondary);
            cursor: pointer;
            color: var(--text-primary);
            font-size: 13px;
            font-weight: 500;
            transition: background 0.15s;
        }

        .user-dropdown-toggle:hover { background: var(--bg-tertiary); }

        .topbar-avatar {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--accent-blue);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
            color: #fff;
        }

        /* Bootstrap dropdown overrides */
        .dropdown-menu {
            border: 0.5px solid var(--border-color);
            border-radius: var(--radius-lg);
            box-shadow: 0 8px 24px rgba(0,0,0,0.10);
            background: var(--bg-primary);
            padding: 6px;
            min-width: 160px;
        }

        .dropdown-item {
            border-radius: var(--radius-md);
            font-size: 13px;
            color: var(--text-primary);
            padding: 7px 10px;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: var(--bg-secondary);
            color: var(--text-primary);
        }

        .dropdown-divider {
            border-color: var(--border-color);
            margin: 4px 0;
        }

        /* ── Content ── */
        .main-content {
            flex: 1;
            padding: 24px;
        }

        /* ── Alert overrides ── */
        .alert {
            border-radius: var(--radius-lg);
            border: 0.5px solid;
            font-size: 13px;
            padding: 12px 16px;
        }

        .alert-success {
            background: var(--accent-teal-light);
            border-color: rgba(15,110,86,0.2);
            color: var(--accent-teal);
        }

        .alert-danger {
            background: #FCEBEB;
            border-color: rgba(163,45,45,0.2);
            color: #A32D2D;
        }

        [data-theme="dark"] .alert-danger {
            background: rgba(163,45,45,0.15);
            color: #f09595;
        }

        .btn-close { filter: none; opacity: 0.5; }
        .btn-close:hover { opacity: 1; }

        /* ── Mobile sidebar overlay ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.4);
            z-index: 200;
        }

        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                left: -220px;
                top: 0;
                z-index: 300;
                transition: left 0.2s;
            }

            .sidebar.open { left: 0; }
            .sidebar-overlay.open { display: block; }
            .mobile-toggle { display: flex; }
        }

        /* ── Import DM Sans from Google Fonts ── */
        @import url('https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;1,9..40,400&display=swap');
    </style>
</head>

<body>

<div class="app-layout">

    {{-- ── Sidebar ── --}}
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-brand">
            <div class="brand-name">Perpustakaan</div>
            <div class="brand-sub">Sistem informasi</div>
        </div>

        <ul class="sidebar-nav">
            <span class="nav-section-label">Menu utama</span>

            <li>
                <a href="{{ route('dashboard') }}"
                   class="nav-link-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('siswas.index') }}"
                   class="nav-link-item {{ request()->routeIs('siswas.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Siswa
                </a>
            </li>
            <li>
                <a href="{{ route('bukus.index') }}"
                   class="nav-link-item {{ request()->routeIs('bukus.*') ? 'active' : '' }}">
                    <i class="bi bi-book"></i> Buku
                </a>
            </li>
            <li>
                <a href="{{ route('kategoris.index') }}"
                   class="nav-link-item {{ request()->routeIs('kategoris.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i> Kategori
                </a>
            </li>
            <li>
                <a href="{{ route('peminjamans.index') }}"
                   class="nav-link-item {{ request()->routeIs('peminjamans.*') ? 'active' : '' }}">
                    <i class="bi bi-arrow-left-right"></i> Peminjaman
                </a>
            </li>

            <span class="nav-section-label">Sistem</span>

            <li>
                <a href="{{ route('users.index') }}"
                   class="nav-link-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                    <i class="bi bi-person-badge"></i> Users
                </a>
            </li>
        </ul>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-avatar">
                    @if(auth()->check())
                        {{ auth()->user()->initials() ?? '?' }}
                    @else
                        ?
                    @endif
                </div>
                <div>
                    <div class="sidebar-user-name">
                        @if(auth()->check()) {{ auth()->user()->name }} @else Guest @endif
                    </div>
                    <div class="sidebar-user-role">Administrator</div>
                </div>
            </div>
        </div>
    </aside>

    {{-- Mobile overlay --}}
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    {{-- ── Main ── --}}
    <div class="main-area">

        {{-- Topbar --}}
        <header class="topbar">
            <div class="topbar-left">
                <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle menu">
                    <i class="bi bi-list"></i>
                </button>
                <div>
                    <div class="topbar-title">@yield('title', 'Dashboard')</div>
                </div>
            </div>

            <div class="topbar-right">
                <div class="topbar-breadcrumb d-none d-md-block">
                    Beranda <span>/ @yield('title', 'Dashboard')</span>
                </div>

                {{-- Notifications --}}
                <div class="icon-btn" title="Notifikasi">
                    <i class="bi bi-bell"></i>
                </div>

                {{-- Dark mode toggle --}}
                <button class="icon-btn" id="themeToggle" title="Toggle tema" style="border:none;">
                    <i class="bi bi-moon" id="themeIcon"></i>
                </button>

                {{-- User dropdown --}}
                <div class="dropdown">
                    <div class="user-dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="topbar-avatar">
                            @if(auth()->check())
                                {{ auth()->user()->initials() ?? '?' }}
                            @else
                                ?
                            @endif
                        </div>
                        <span class="d-none d-md-inline">
                            @if(auth()->check()) {{ auth()->user()->name }} @else Guest @endif
                        </span>
                        <i class="bi bi-chevron-down" style="font-size:10px; opacity:0.5;"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('settings.profile.edit') }}">
                                <i class="bi bi-person me-2" style="font-size:12px;"></i>Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item" style="color:#A32D2D;">
                                    <i class="bi bi-box-arrow-right me-2" style="font-size:12px;"></i>Sign out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </header>

        {{-- Content --}}
        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</div>

<!-- Bootstrap Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

<script>
    // ── Dark Mode ──
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon   = document.getElementById('themeIcon');

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem('theme', theme);
        themeIcon.className = theme === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
    }

    applyTheme(localStorage.getItem('theme') || 'light');

    themeToggle.addEventListener('click', () => {
        const current = document.documentElement.getAttribute('data-theme');
        applyTheme(current === 'dark' ? 'light' : 'dark');
    });

    // ── Mobile sidebar ──
    const sidebar        = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const mobileToggle   = document.getElementById('mobileToggle');

    mobileToggle.addEventListener('click', () => {
        sidebar.classList.toggle('open');
        sidebarOverlay.classList.toggle('open');
    });

    sidebarOverlay.addEventListener('click', () => {
        sidebar.classList.remove('open');
        sidebarOverlay.classList.remove('open');
    });

    // ── Live search ──
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('keyup', function () {
                const term = this.value.toLowerCase();
                document.querySelectorAll('table tbody tr').forEach(row => {
                    row.style.display = row.textContent.toLowerCase().includes(term) ? '' : 'none';
                });
            });
        }
    });
</script>

@stack('scripts')
</body>
</html>