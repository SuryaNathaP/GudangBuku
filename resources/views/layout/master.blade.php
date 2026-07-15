<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') | GudangBuku</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- Preconnect to reduce DNS + TLS round-trip for all 3 external domains --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600&family=Outfit:wght@400;600;700&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script>
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
    </script>

    <style>
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f8fafc;
            --bg-tertiary: #f1f5f9;
            --text-primary: #0f172a;
            --text-secondary: #475569;
            --text-tertiary: #94a3b8;
            --border: #e2e8f0;
            --border-hover: #cbd5e1;
            --sidebar-bg: #0f172a;
            --sidebar-text: #cbd5e1;
            --sidebar-muted: #64748b;
            --sidebar-hover: rgba(255, 255, 255, 0.05);
            --sidebar-active: #6366f1;
            --topbar-bg: #ffffff;
            --card-bg: #ffffff;
            --input-bg: #ffffff;
            --table-stripe: rgba(0, 0, 0, 0.02);
            --table-hover: rgba(0, 0, 0, 0.04);
            --accent-blue: #6366f1;
            --accent-blue-bg: #e0e7ff;
            --accent-blue-txt: #4f46e5;
            --accent-teal: #0d9488;
            --accent-teal-bg: #ccfbf1;
            --accent-amber: #d97706;
            --accent-amber-bg: #fef3c7;
            --accent-green: #16a34a;
            --accent-green-bg: #dcfce7;
            --accent-red: #e11d48;
            --accent-red-bg: #ffe4e6;
        }

        [data-theme="dark"] {
            --bg-primary: #0f172a;
            --bg-secondary: #1e293b;
            --bg-tertiary: #0a0f1d;
            --text-primary: #f8fafc;
            --text-secondary: #cbd5e1;
            --text-tertiary: #94a3b8;
            --border: #334155;
            --border-hover: #475569;
            --topbar-bg: #0f172a;
            --card-bg: #1e293b;
            --input-bg: #0f172a;
            --table-stripe: rgba(255, 255, 255, 0.02);
            --table-hover: rgba(255, 255, 255, 0.04);
            --accent-blue-bg: rgba(99, 102, 241, 0.15);
            --accent-blue-txt: #818cf8;
            --accent-teal-bg: rgba(20, 184, 166, 0.15);
            --accent-amber-bg: rgba(245, 158, 11, 0.15);
            --accent-green-bg: rgba(34, 197, 94, 0.15);
            --accent-red-bg: rgba(244, 63, 94, 0.15);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', system-ui, sans-serif !important;
            background: var(--bg-tertiary) !important;
            color: var(--text-primary) !important;
            font-size: 14px;
            line-height: 1.55;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
        }

        .app {
            display: flex;
            min-height: 100vh;
        }

        /* ── Sidebar ── */
        .sidebar {
            width: 256px;
            background: var(--sidebar-bg);
            display: flex;
            flex-direction: column;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            flex-shrink: 0;
            scrollbar-width: none;
        }

        .sidebar::-webkit-scrollbar {
            display: none;
        }

        .sidebar-brand {
            padding: 22px 20px 16px;
            border-bottom: 0.5px solid rgba(255, 255, 255, 0.06);
        }

        .brand-name {
            font-size: 16px;
            font-weight: 600;
            color: #e8e8e4;
            letter-spacing: -0.015em;
        }

        .brand-sub {
            font-size: 11.5px;
            color: #8c8c88;
            margin-top: 3px;
        }

        /* Pagination Styling */
        .pagination { margin-bottom: 0; }
        .page-link { 
            background-color: var(--card-bg) !important; 
            border-color: var(--border) !important; 
            color: var(--text-primary) !important; 
            font-size: 12px;
            font-family: 'DM Sans', sans-serif;
            transition: all 0.2s;
        }
        .page-link:hover { 
            background-color: var(--table-hover) !important; 
            color: var(--accent-blue) !important; 
        }
        .page-item.active .page-link { 
            background-color: var(--accent-blue) !important; 
            border-color: var(--accent-blue) !important; 
            color: #fff !important; 
        }
        .page-item.disabled .page-link { 
            color: var(--text-tertiary) !important; 
            opacity: 0.6;
        }

        .sidebar-nav {
            flex: 1;
            padding: 14px 12px;
            list-style: none;
        }

        .nav-section-label {
            display: block;
            font-size: 9.5px;
            color: var(--sidebar-muted);
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 12px 10px 5px;
        }

        .nav-link-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            color: var(--sidebar-text);
            font-size: 13.5px;
            font-weight: 400;
            transition: background 0.12s, color 0.12s;
            margin-bottom: 1px;
        }

        .nav-link-item:hover {
            background: var(--sidebar-hover);
            color: #e8e8e4;
        }

        .nav-link-item.active {
            background: var(--sidebar-active);
            color: #fff;
            font-weight: 500;
        }

        .nav-link-item i {
            font-size: 15px;
            flex-shrink: 0;
            opacity: 0.75;
        }

        .nav-link-item.active i,
        .nav-link-item:hover i {
            opacity: 1;
        }

        .sidebar-footer {
            padding: 14px 16px;
            border-top: 0.5px solid rgba(255, 255, 255, 0.06);
        }

        .sidebar-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--sidebar-active);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 600;
            color: #fff;
            flex-shrink: 0;
        }

        .sidebar-user-name {
            font-size: 13px;
            font-weight: 500;
            color: #e8e8e4;
        }

        .sidebar-user-role {
            font-size: 10.5px;
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
            border-bottom: 0.5px solid var(--border);
            padding: 0 24px;
            height: 56px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .topbar-title {
            font-size: 15px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .topbar-breadcrumb {
            font-size: 11.5px;
            color: var(--text-tertiary);
            margin-right: 4px;
        }

        .topbar-breadcrumb span {
            color: var(--text-primary);
        }

        .icon-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            background: var(--bg-secondary);
            border: 0.5px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 14px;
            transition: background 0.12s, color 0.12s;
        }

        .icon-btn:hover {
            background: var(--bg-tertiary);
            color: var(--text-primary);
        }

        /* User pill — now a <button> so Bootstrap dropdown works reliably */
        .user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 4px 10px 4px 4px;
            border-radius: 99px;
            border: 0.5px solid var(--border);
            background: var(--bg-secondary);
            cursor: pointer;
            color: var(--text-primary);
            font-size: 13px;
            font-weight: 500;
            transition: background 0.12s;
        }

        .user-pill:hover {
            background: var(--bg-tertiary);
        }

        .topbar-avatar {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            background: var(--sidebar-active);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
            color: #fff;
        }

        /* Dropdown overrides */
        .dropdown-menu {
            background: var(--card-bg) !important;
            border: 0.5px solid var(--border) !important;
            border-radius: 12px !important;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.16) !important;
            padding: 6px !important;
            min-width: 160px;
        }

        .dropdown-item {
            border-radius: 7px !important;
            font-size: 13px !important;
            color: var(--text-primary) !important;
            padding: 7px 10px !important;
            font-family: 'DM Sans', sans-serif !important;
            background: transparent !important;
            border: none !important;
            width: 100%;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background: var(--bg-secondary) !important;
        }

        .dropdown-item.signout {
            color: #E24B4A !important;
        }

        .dropdown-divider {
            border-color: var(--border) !important;
            margin: 4px 0 !important;
        }

        /* ── Mobile toggle ── */
        .mobile-toggle {
            display: none;
            border: 0.5px solid var(--border);
            background: var(--bg-secondary);
            color: var(--text-secondary);
            border-radius: 8px;
            padding: 5px 9px;
            cursor: pointer;
            font-size: 15px;
            line-height: 1;
        }

        /* ── Content ── */
        .main-content {
            flex: 1;
            padding: 24px;
        }

        /* ── lib-card helpers for child views ── */
        .lib-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .lib-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 0.5px solid var(--border);
        }

        .lib-card-title {
            font-size: 14px;
            font-weight: 500;
            color: var(--text-primary);
        }

        /* ── Bootstrap Card Overrides ── */
        .card {
            background: var(--card-bg) !important;
            border: 1px solid var(--border) !important;
            border-radius: 16px !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1) !important;
        }

        .card-header {
            background: transparent !important;
            border-bottom: 0.5px solid var(--border) !important;
            color: var(--text-primary) !important;
        }

        /* ── Tables ── */
        .table {
            --bs-table-color: var(--text-primary);
            --bs-table-bg: transparent;
            color: var(--text-primary) !important;
            border-color: var(--border) !important;
        }

        .table thead th {
            background: var(--bg-secondary) !important;
            color: var(--text-tertiary) !important;
            font-size: 10.5px !important;
            letter-spacing: 0.07em !important;
            font-weight: 500 !important;
            border-bottom: 0.5px solid var(--border) !important;
            padding: 10px 14px !important;
        }

        .table tbody tr {
            border-color: var(--border) !important;
        }

        .table tbody tr:hover td {
            background: var(--table-hover) !important;
        }

        .table-striped>tbody>tr:nth-of-type(odd)>* {
            background: var(--table-stripe) !important;
            color: var(--text-primary) !important;
        }

        .table tbody td {
            padding: 11px 14px !important;
            color: var(--text-primary) !important;
            font-size: 13.5px;
        }

        /* ── Form controls ── */
        .form-control,
        .form-select {
            background: var(--input-bg) !important;
            border: 0.5px solid var(--border) !important;
            border-radius: 8px !important;
            color: var(--text-primary) !important;
            font-size: 13px !important;
            font-family: 'DM Sans', sans-serif !important;
        }

        .form-control::placeholder {
            color: var(--text-tertiary) !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--accent-blue) !important;
            box-shadow: 0 0 0 3px rgba(24, 95, 165, 0.12) !important;
            background: var(--input-bg) !important;
        }

        .form-label {
            font-size: 12.5px;
            color: var(--text-secondary);
            font-weight: 500;
            margin-bottom: 5px;
        }

        /* ── Buttons ── */
        .btn {
            font-family: 'DM Sans', sans-serif !important;
            border-radius: 10px !important;
            transition: all 0.2s ease !important;
        }

        .btn-primary {
            background: var(--accent-blue) !important;
            border-color: var(--accent-blue) !important;
            color: #fff !important;
            font-size: 13px !important;
            font-weight: 500 !important;
        }

        .btn-primary:hover {
            background: #4f46e5 !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 4px 14px rgba(99, 102, 241, 0.4) !important;
            transform: translateY(-1px) !important;
        }

        .btn-sm {
            font-size: 12.5px !important;
            padding: 5px 12px !important;
        }

        /* ── Badges ── */
        .badge {
            font-family: 'DM Sans', sans-serif !important;
            font-size: 11px !important;
            font-weight: 500 !important;
            border-radius: 6px !important;
            padding: 3px 8px !important;
        }

        .bg-primary {
            background: var(--accent-blue-bg) !important;
            color: var(--accent-blue-txt) !important;
        }

        .bg-success {
            background: var(--accent-green-bg) !important;
            color: var(--accent-green) !important;
        }

        .bg-warning {
            background: var(--accent-amber-bg) !important;
            color: var(--accent-amber) !important;
        }

        .bg-danger {
            background: var(--accent-red-bg) !important;
            color: var(--accent-red) !important;
        }

        .bg-info {
            background: var(--accent-teal-bg) !important;
            color: var(--accent-teal) !important;
        }

        .text-dark {
            color: var(--text-primary) !important;
        }

        /* ── Alerts ── */
        .alert {
            border-radius: 10px !important;
            font-size: 13px !important;
            padding: 12px 16px !important;
            border-width: 0.5px !important;
        }

        .alert-success {
            background: var(--accent-green-bg) !important;
            border-color: rgba(59, 109, 17, 0.2) !important;
            color: var(--accent-green) !important;
        }

        .alert-danger {
            background: var(--accent-red-bg) !important;
            border-color: rgba(163, 45, 45, 0.2) !important;
            color: var(--accent-red) !important;
        }

        /* Muted text */
        .text-muted {
            color: var(--text-secondary) !important;
        }

        .text-success {
            color: var(--accent-green) !important;
        }

        .text-danger {
            color: var(--accent-red) !important;
        }

        .text-primary {
            color: var(--accent-blue) !important;
        }

        /* ── Mobile sidebar ── */
        .sidebar-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            z-index: 200;
        }

        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                left: -256px;
                top: 0;
                z-index: 300;
                transition: left 0.2s;
            }

            .sidebar.open {
                left: 0;
            }

            .sidebar-overlay.open {
                display: block;
            }

            .mobile-toggle {
                display: flex;
            }

            .topbar-breadcrumb {
                display: none !important;
            }
        }

        /* ── Delete Modal Overlay ── */
        #deleteModal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(0, 0, 0, 0.55);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            align-items: center;
            justify-content: center;
        }
        #deleteModal.dm-open { display: flex; }

        /* ── Modal Box ── */
        .dm-box {
            background: var(--card-bg);
            border: 0.5px solid var(--border);
            border-radius: 20px;
            width: min(400px, 92vw);
            box-shadow:
                0 0 0 1px rgba(255,255,255,0.04),
                0 24px 60px rgba(0, 0, 0, 0.5),
                0 8px 20px rgba(0, 0, 0, 0.3);
            animation: dmSlideIn 0.28s cubic-bezier(0.22, 1, 0.36, 1) both;
            overflow: hidden;
            position: relative;
        }

        @keyframes dmSlideIn {
            from { opacity: 0; transform: translateY(24px) scale(0.94); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        /* Red accent bar at top */
        .dm-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, #A32D2D, #E24B4A, #A32D2D);
            border-radius: 20px 20px 0 0;
        }

        /* ── Icon ── */
        .dm-icon-wrap {
            display: flex;
            justify-content: center;
            padding: 32px 24px 0;
        }
        .dm-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: var(--accent-red-bg);
            border: 1.5px solid rgba(163, 45, 45, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            animation: dmIconPop 0.35s 0.1s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        @keyframes dmIconPop {
            from { transform: scale(0.5); opacity: 0; }
            to   { transform: scale(1); opacity: 1; }
        }
        .dm-icon svg {
            width: 28px; height: 28px;
            color: var(--accent-red);
            stroke: var(--accent-red);
        }

        /* ── Text ── */
        .dm-body {
            padding: 20px 28px 24px;
            text-align: center;
        }
        .dm-title {
            font-size: 17px;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 8px;
            letter-spacing: -0.01em;
        }
        .dm-subtitle {
            font-size: 13px;
            color: var(--text-secondary);
            line-height: 1.6;
        }
        .dm-item-name {
            display: inline-block;
            margin-top: 10px;
            padding: 6px 14px;
            background: var(--accent-red-bg);
            border: 0.5px solid rgba(163, 45, 45, 0.2);
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--accent-red);
            max-width: 100%;
            word-break: break-word;
        }

        /* ── Buttons ── */
        .dm-footer {
            display: flex;
            gap: 10px;
            padding: 0 20px 20px;
        }
        .dm-btn-cancel {
            flex: 1;
            padding: 11px 0;
            border-radius: 10px;
            border: 0.5px solid var(--border);
            background: var(--bg-secondary);
            color: var(--text-secondary);
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s, border-color 0.15s, color 0.15s;
        }
        .dm-btn-cancel:hover {
            background: var(--bg-tertiary);
            border-color: var(--border-hover);
            color: var(--text-primary);
        }
        .dm-btn-delete {
            flex: 1.4;
            padding: 11px 0;
            border-radius: 10px;
            border: none;
            background: linear-gradient(135deg, #c0392b, #A32D2D);
            color: #fff;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            box-shadow: 0 4px 14px rgba(163, 45, 45, 0.35);
            transition: opacity 0.15s, box-shadow 0.15s, transform 0.1s;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }
        .dm-btn-delete:hover {
            opacity: 0.9;
            box-shadow: 0 6px 20px rgba(163, 45, 45, 0.45);
            transform: translateY(-1px);
        }
        .dm-btn-delete:active {
            transform: translateY(0);
        }
        .dm-btn-delete svg {
            width: 14px; height: 14px;
            stroke: #fff;
        }
    </style>
</head>

<body>
    <div class="app">

        {{-- Sidebar --}}
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" style="display:flex; align-items:center; gap:12px; text-decoration:none;">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:34px; height:34px; object-fit:contain;">
                    <div>
                        <div class="brand-name" style="font-family:'Outfit', sans-serif; font-size:19px; font-weight:700; letter-spacing:-0.5px; display:flex;">
                            <span style="color:#818cf8;">Gudang</span><span style="color:#f9b300;">Buku</span>
                        </div>
                        <div class="brand-sub" style="font-size:10px; color:#8c8c88; margin-top:-2px; font-weight:400;">Sistem Peminjaman Buku</div>
                    </div>
                </a>
            </div>

            <ul class="sidebar-nav">
                <span class="nav-section-label">Menu Utama</span>
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
                <div class="sidebar-user mb-3">
                    <div class="sidebar-avatar">
                        @if (auth()->check())
                            {{ auth()->user()->initials() ?? '?' }}
                        @else
                            ?
                        @endif
                    </div>
                    <div>
                        <div class="sidebar-user-name">
                            @if (auth()->check())
                                {{ auth()->user()->name }}
                            @else
                                Guest
                            @endif
                        </div>
                        <div class="sidebar-user-role">Administrator</div>
                    </div>
                </div>
                
                <a href="{{ route('settings.index') }}"
                    class="nav-link-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i> Pengaturan
                </a>
            </div>
        </aside>

        <div class="sidebar-overlay" id="sidebarOverlay"></div>

        {{-- Main --}}
        <div class="main-area">
            <header class="topbar">
                <div class="d-flex align-items-center gap-3">
                    <button class="mobile-toggle" id="mobileToggle" type="button"><i class="bi bi-list"></i></button>
                    <div class="topbar-title">@yield('title', 'Dashboard')</div>
                </div>

                <div class="topbar-right">
                    <div class="topbar-breadcrumb d-none d-md-block">
                        Beranda / <span>@yield('title', 'Dashboard')</span>
                    </div>
                    <div class="icon-btn" title="Notifikasi">
                        <i class="bi bi-bell"></i>
                    </div>
                    <button class="icon-btn" id="themeToggle" type="button" title="Toggle tema"
                        style="border:none; cursor:pointer;">
                        <i class="bi bi-moon" id="themeIcon"></i>
                    </button>

                    <div class="dropdown">
                        <button class="user-pill" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="topbar-avatar">
                                @if (auth()->check())
                                    {{ auth()->user()->initials() ?? '?' }}
                                @else
                                    ?
                                @endif
                            </div>
                            <span class="d-none d-md-inline">
                                @if (auth()->check())
                                    {{ auth()->user()->name }}
                                @else
                                    Guest
                                @endif
                            </span>
                            <i class="bi bi-chevron-down" style="font-size:10px; opacity:0.5;"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('settings.profile.edit') }}">
                                    <i class="bi bi-person me-2" style="font-size:12px;"></i>Settings
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item signout">
                                        <i class="bi bi-box-arrow-right me-2" style="font-size:12px;"></i>Sign out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </header>

            <main class="main-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                        <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    {{-- Bootstrap JS: defer so it never blocks HTML parsing --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
        defer>
    </script>

    <script>
        // Theme
        const themeToggle = document.getElementById('themeToggle');
        const themeIcon = document.getElementById('themeIcon');

        function applyTheme(t) {
            document.documentElement.setAttribute('data-theme', t);
            localStorage.setItem('theme', t);
            themeIcon.className = t === 'dark' ? 'bi bi-sun' : 'bi bi-moon';
        }
        applyTheme(localStorage.getItem('theme') || 'dark');
        themeToggle.addEventListener('click', () => {
            applyTheme(document.documentElement.getAttribute('data-theme') === 'dark' ? 'light' : 'dark');
        });

        // Mobile sidebar
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        document.getElementById('mobileToggle').addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('open');
        });
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('open');
        });

        // Live search
        document.addEventListener('DOMContentLoaded', () => {
            const s = document.getElementById('searchInput');
            if (s) s.addEventListener('keyup', function() {
                const q = this.value.toLowerCase();
                document.querySelectorAll('table tbody tr').forEach(r => {
                    r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
                });
            });
        });
    </script>

    {{-- ══════════════════════════════════════════════════════════
         GLOBAL DELETE CONFIRMATION MODAL
         Digunakan di semua halaman: siswas, bukus, kategoris,
         peminjamans, users.
         Panggil dengan: confirmDelete(formElement, 'Nama Item')
    ══════════════════════════════════════════════════════════ --}}

    {{-- Delete Modal HTML --}}
    <div id="deleteModal" role="dialog" aria-modal="true" aria-labelledby="dmTitle">
        <div class="dm-box">
            <div class="dm-icon-wrap">
                <div class="dm-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                        <path d="M10 11v6M14 11v6"/>
                        <path d="M9 6V4a1 1 0 011-1h4a1 1 0 011 1v2"/>
                    </svg>
                </div>
            </div>
            <div class="dm-body">
                <div class="dm-title" id="dmTitle">Hapus Data?</div>
                <div class="dm-subtitle">
                    Tindakan ini tidak dapat dibatalkan.<br>
                    Data berikut akan dihapus secara permanen:
                </div>
                <div class="dm-item-name" id="dmItemName">—</div>
            </div>
            <div class="dm-footer">
                <button class="dm-btn-cancel" id="dmCancelBtn" type="button">Batal</button>
                <button class="dm-btn-delete" id="dmConfirmBtn" type="button">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="3 6 5 6 21 6"/>
                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                    </svg>
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const modal     = document.getElementById('deleteModal');
            const itemLabel = document.getElementById('dmItemName');
            const cancelBtn = document.getElementById('dmCancelBtn');
            const confirmBtn = document.getElementById('dmConfirmBtn');
            let _pendingForm = null;

            // Public API
            window.confirmDelete = function (formEl, label) {
                _pendingForm = formEl;
                itemLabel.textContent = label || 'Data ini';
                modal.classList.add('dm-open');
                cancelBtn.focus();
            };

            function closeModal() {
                modal.classList.remove('dm-open');
                _pendingForm = null;
            }

            cancelBtn.addEventListener('click', closeModal);

            confirmBtn.addEventListener('click', function () {
                if (_pendingForm) {
                    const form = _pendingForm;
                    closeModal();
                    form.submit();
                }
            });

            // Close on backdrop click
            modal.addEventListener('click', function (e) {
                if (e.target === modal) closeModal();
            });

            // Close on Escape
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape' && modal.classList.contains('dm-open')) closeModal();
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
