@extends('layout.master')

@section('title', 'Dashboard')

@section('content')

    <style>
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }

        @media (max-width: 768px) {
            .stat-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .stat-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            border-radius: 12px 12px 0 0;
        }

        .stat-card.blue::before {
            background: #6366f1;
        }

        .stat-card.teal::before {
            background: #0F6E56;
        }

        .stat-card.amber::before {
            background: #854F0B;
        }

        .stat-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .stat-icon-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .stat-icon {
            width: 38px;
            height: 38px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
        }

        .stat-icon.blue {
            background: var(--accent-blue-bg);
            color: var(--accent-blue);
        }

        .stat-icon.teal {
            background: var(--accent-teal-bg);
            color: var(--accent-teal);
        }

        .stat-icon.amber {
            background: var(--accent-amber-bg);
            color: var(--accent-amber);
        }

        .stat-pill {
            font-size: 10px;
            font-weight: 600;
            padding: 4px 10px;
            border-radius: 99px;
            display: inline-block;
        }

        .stat-pill.green {
            background: #EAF3DE;
            color: #3B6D11;
        }

        [data-theme="dark"] .stat-pill.green {
            background: #EAF3DE;
            color: #3B6D11;
            font-weight: 500;
        }

        .stat-pill.dark {
            background: #4a4a4a;
            color: #fff;
        }

        [data-theme="dark"] .stat-pill.dark {
            background: #2c2c2c;
            color: #e8e8e4;
            font-weight: 500;
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 3px;
            font-weight: 500;
        }

        .stat-value {
            font-size: 32px;
            font-weight: 600;
            color: var(--text-primary);
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-sub {
            font-size: 11.5px;
            color: var(--text-tertiary);
        }

        .dashboard-bottom {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 16px;
        }

        @media (max-width: 992px) {
            .dashboard-bottom {
                grid-template-columns: 1fr;
            }
        }

        .panel-card {
            background: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
        }

        .panel-header {
            padding: 16px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 0.5px solid transparent;
        }

        .panel-title {
            font-size: 14px;
            font-weight: 600;
            color: var(--text-primary);
        }

        .panel-link {
            font-size: 12px;
            color: var(--accent-blue);
        }

        .panel-link:hover {
            text-decoration: underline;
        }

        /* Aktivitas Terbaru */
        .activity-list {
            padding: 0 20px 20px 20px;
            list-style: none;
        }

        .activity-item {
            position: relative;
            padding-left: 20px;
            padding-bottom: 16px;
            margin-bottom: 16px;
            border-bottom: 0.5px solid var(--border);
        }

        .activity-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .activity-item::before {
            content: '';
            position: absolute;
            left: 0;
            top: 6px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .activity-item.blue::before {
            background: var(--accent-blue);
        }

        .activity-item.green::before {
            background: var(--accent-green);
        }

        .activity-item.orange::before {
            background: var(--accent-amber);
        }

        .activity-text {
            font-size: 13.5px;
            color: var(--text-primary);
            margin-bottom: 4px;
            line-height: 1.4;
        }

        .activity-text strong {
            font-weight: 600;
        }

        .activity-time {
            font-size: 11px;
            color: var(--text-tertiary);
        }

        /* Aksi Cepat */
        .quick-actions {
            padding: 0 20px 20px 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .qa-btn {
            display: flex;
            align-items: center;
            gap: 14px;
            background: transparent;
            border: 0.5px solid var(--border);
            border-radius: 10px;
            padding: 14px 16px;
            text-align: left;
            cursor: pointer;
            transition: background 0.12s, border-color 0.12s;
        }

        .qa-btn:hover {
            background: var(--bg-secondary);
            border-color: var(--border-hover);
        }

        .qa-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            flex-shrink: 0;
        }

        .qa-icon.blue {
            background: var(--accent-blue-bg);
            color: var(--accent-blue);
        }

        .qa-icon.teal {
            background: var(--accent-teal-bg);
            color: var(--accent-teal);
        }

        .qa-icon.amber {
            background: var(--accent-amber-bg);
            color: var(--accent-amber);
        }

        .qa-text-group {
            flex: 1;
        }

        .qa-title {
            font-size: 13px;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 2px;
        }

        .qa-desc {
            font-size: 11.5px;
            color: var(--text-secondary);
        }

        /* Modal Styles */
        .modal-overlay {
            display: none; position: fixed; inset: 0; z-index: 1000;
            background: rgba(0,0,0,0.6); backdrop-filter: blur(6px);
            align-items: center; justify-content: center;
        }
        .modal-overlay.open { display: flex; }

        .modal-box {
            background: var(--card-bg); border: 1px solid var(--border);
            border-radius: 20px; width: min(600px, 94vw); max-height: 85vh;
            box-shadow: 0 32px 80px rgba(0,0,0,0.4);
            animation: modalIn 0.25s cubic-bezier(0.22,1,0.36,1) both;
            display: flex; flex-direction: column;
        }
        @keyframes modalIn {
            from { opacity: 0; transform: translateY(20px) scale(0.96); }
            to   { opacity: 1; transform: translateY(0) scale(1); }
        }

        .modal-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px; border-bottom: 0.5px solid var(--border);
        }
        .modal-title { font-size: 16px; font-weight: 600; color: var(--text-primary); }
        .modal-close {
            width: 28px; height: 28px; border-radius: 6px; border: none;
            background: var(--bg-secondary); color: var(--text-tertiary);
            font-size: 16px; cursor: pointer; display: flex; align-items: center;
            justify-content: center; transition: background 0.12s;
        }
        .modal-close:hover { background: var(--border); }

        .modal-body {
            padding: 20px; overflow-y: auto; flex: 1;
        }
    </style>

    {{-- Stat Cards --}}
    <div class="stat-grid">

        {{-- Total Siswa --}}
        <div class="stat-card blue">
            <div class="stat-top">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon blue"><i class="bi bi-people"></i></div>
                    <span class="stat-pill green">+{{ \App\Models\Siswa::whereMonth('created_at', now()->month)->count() }}
                        bulan ini</span>
                </div>
            </div>
            <div class="stat-label">Total Siswa</div>
            <div class="stat-value">{{ \App\Models\Siswa::count() }}</div>
            <div class="stat-sub">Siswa terdaftar aktif</div>
        </div>

        {{-- Total Buku --}}
        <div class="stat-card teal">
            <div class="stat-top">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon teal"><i class="bi bi-book"></i></div>
                    <span
                        class="stat-pill green">+{{ \App\Models\Buku::where('created_at', '>=', now()->subWeek())->count() }}
                        minggu ini</span>
                </div>
            </div>
            <div class="stat-label">Total Buku</div>
            <div class="stat-value">{{ \App\Models\Buku::count() }}</div>
            <div class="stat-sub">Koleksi buku tersedia</div>
        </div>

        {{-- Peminjaman Aktif --}}
        <div class="stat-card amber">
            <div class="stat-top">
                <div class="stat-icon-wrapper">
                    <div class="stat-icon amber"><i class="bi bi-list-ul"></i></div>
                    <span class="stat-pill dark">Aktif</span>
                </div>
            </div>
            <div class="stat-label">Peminjaman Aktif</div>
            <div class="stat-value">{{ \App\Models\Peminjaman::where('status', 'dipinjam')->count() }}</div>
            <div class="stat-sub">Sedang dipinjam</div>
        </div>

    </div>

    {{-- Bottom Section --}}
    <div class="dashboard-bottom">

        {{-- Aktivitas Terbaru --}}
        <div class="panel-card">
            <div class="panel-header">
                <div class="panel-title">Aktivitas terbaru</div>
                <a href="javascript:void(0)" onclick="document.getElementById('allActivitiesModal').classList.add('open')" class="panel-link">Lihat semua</a>
            </div>
            <ul class="activity-list">
                @forelse ($activities as $activity)
                    <li class="activity-item {{ $activity['color'] }}">
                        <div class="activity-text">
                            {{ $activity['text'] }} <strong>{{ $activity['bold'] }}</strong>
                        </div>
                        <div class="activity-time">
                            {{ $activity['time'] ? $activity['time']->diffForHumans() : '-' }}
                        </div>
                    </li>
                @empty
                    <li class="activity-item">
                        <div class="activity-text" style="color: var(--text-tertiary); font-style: italic;">
                            Belum ada aktivitas terbaru.
                        </div>
                    </li>
                @endforelse
            </ul>
        </div>

        {{-- Aksi Cepat --}}
        <div class="panel-card">
            <div class="panel-header">
                <div class="panel-title">Aksi cepat</div>
            </div>
            <div class="quick-actions">
                <a href="{{ route('siswas.add') }}" class="qa-btn">
                    <div class="qa-icon blue"><i class="bi bi-person-plus"></i></div>
                    <div class="qa-text-group">
                        <div class="qa-title">Tambah siswa baru</div>
                        <div class="qa-desc">Daftarkan siswa ke sistem</div>
                    </div>
                </a>
                <a href="{{ route('bukus.add') }}" class="qa-btn">
                    <div class="qa-icon teal"><i class="bi bi-book"></i></div>
                    <div class="qa-text-group">
                        <div class="qa-title">Tambah buku baru</div>
                        <div class="qa-desc">Masukkan koleksi buku</div>
                    </div>
                </a>
                <a href="{{ route('peminjamans.add') }}" class="qa-btn">
                    <div class="qa-icon amber"><i class="bi bi-card-list"></i></div>
                    <div class="qa-text-group">
                        <div class="qa-title">Catat peminjaman</div>
                        <div class="qa-desc">Rekam transaksi pinjam</div>
                    </div>
                </a>
            </div>
        </div>

    </div>

    {{-- Modal Semua Aktivitas --}}
    <div class="modal-overlay" id="allActivitiesModal" onclick="if(event.target === this) this.classList.remove('open')">
        <div class="modal-box">
            <div class="modal-header">
                <div class="modal-title">Semua Aktivitas (Terbaru)</div>
                <button class="modal-close" onclick="document.getElementById('allActivitiesModal').classList.remove('open')">&#x2715;</button>
            </div>
            <div class="modal-body">
                <ul class="activity-list" style="padding: 0;">
                    @forelse ($allActivities as $activity)
                        <li class="activity-item {{ $activity['color'] }}">
                            <div class="activity-text">
                                {{ $activity['text'] }} <strong>{{ $activity['bold'] }}</strong>
                            </div>
                            <div class="activity-time">
                                {{ $activity['time'] ? $activity['time']->diffForHumans() : '-' }}
                                <span class="text-muted" style="font-size: 10px; margin-left: 6px;">({{ $activity['time'] ? $activity['time']->format('d M Y H:i') : '' }})</span>
                            </div>
                        </li>
                    @empty
                        <li class="activity-item">
                            <div class="activity-text" style="color: var(--text-tertiary); font-style: italic;">
                                Belum ada aktivitas.
                            </div>
                        </li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

@endsection
