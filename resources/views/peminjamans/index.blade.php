@extends('layout.master')

@section('title', 'Daftar Peminjaman')

@section('content')

<style>
    .page-card { background: var(--card-bg); border: 0.5px solid var(--border); border-radius: 12px; overflow: hidden; }
    .page-card-header { display: flex; align-items: center; justify-content: space-between; padding: 16px 20px; border-bottom: 0.5px solid var(--border); gap: 12px; }
    .page-card-title { font-size: 14px; font-weight: 500; color: var(--text-primary); }
    .header-actions { display: flex; align-items: center; gap: 8px; }
    .search-input {
        background: var(--input-bg) !important; border: 0.5px solid var(--border) !important;
        border-radius: 8px !important; color: var(--text-primary) !important;
        font-size: 12.5px !important; font-family: 'DM Sans', sans-serif !important;
        padding: 6px 12px !important; width: 200px; outline: none;
    }
    .search-input:focus { border-color: var(--accent-blue) !important; box-shadow: 0 0 0 3px rgba(24,95,165,0.1) !important; }
    .search-input::placeholder { color: var(--text-tertiary) !important; }
    .add-btn {
        background: var(--accent-blue); color: #fff; border: none; border-radius: 8px;
        font-size: 12.5px; font-weight: 500; padding: 6px 14px;
        font-family: 'DM Sans', sans-serif; white-space: nowrap; cursor: pointer;
        text-decoration: none; display: inline-flex; align-items: center; gap: 5px; transition: background 0.12s;
    }
    .add-btn:hover { background: #0C447C; color: #fff; }
    .tbl { width: 100%; border-collapse: collapse; }
    .tbl thead th {
        background: var(--bg-secondary); color: var(--text-tertiary); font-size: 10.5px;
        letter-spacing: 0.07em; font-weight: 500; text-transform: uppercase;
        padding: 10px 16px; border-bottom: 0.5px solid var(--border); white-space: nowrap;
    }
    .tbl tbody td { padding: 12px 16px; color: var(--text-primary); font-size: 13.5px; border-bottom: 0.5px solid var(--border); }
    .tbl tbody tr:last-child td { border-bottom: none; }
    .tbl tbody tr:hover td { background: var(--table-hover); }
    .id-badge { display: inline-block; background: var(--bg-secondary); color: var(--text-tertiary); font-size: 11px; font-weight: 500; padding: 2px 7px; border-radius: 5px; font-family: monospace; }

    .status-badge {
        display: inline-block; font-size: 11px; font-weight: 500;
        padding: 3px 9px; border-radius: 6px; white-space: nowrap;
    }
    .status-dipinjam  { background: var(--accent-amber-bg); color: var(--accent-amber); }
    .status-kembali   { background: var(--accent-green-bg); color: var(--accent-green); }
    .status-terlambat { background: var(--accent-red-bg);   color: var(--accent-red); }
    .status-info      { background: var(--accent-teal-bg);  color: var(--accent-teal); }

    /* ── Denda cell ── */
    .denda-cell { display: flex; align-items: center; gap: 8px; white-space: nowrap; }
    .denda-amount { font-size: 12px; font-weight: 600; color: var(--accent-red); }
    .denda-lunas {
        font-size: 11px; font-weight: 500; color: var(--accent-green);
        background: var(--accent-green-bg); padding: 2px 8px; border-radius: 5px;
    }
    .denda-none { color: var(--text-tertiary); font-size: 12px; }

    /* Pay button */
    .btn-bayar {
        display: inline-flex; align-items: center; justify-content: center;
        width: 26px; height: 26px; border-radius: 6px;
        background: var(--accent-green-bg); border: 0.5px solid var(--accent-green);
        color: var(--accent-green); cursor: pointer; transition: all 0.15s; flex-shrink: 0;
    }
    .btn-bayar:hover { background: var(--accent-green); color: #fff; }
    .btn-bayar svg { width: 13px; height: 13px; }

    .row-actions { display: flex; align-items: center; gap: 12px; justify-content: center; }
    .act-edit { color: var(--accent-blue); font-size: 13px; font-weight: 500; }
    .act-edit:hover { opacity: 0.7; color: var(--accent-blue); }
    .act-del  { color: var(--accent-red);  font-size: 13px; font-weight: 500; }
    .act-del:hover  { opacity: 0.7; color: var(--accent-red); }
    .empty-row td { padding: 40px 16px !important; text-align: center; color: var(--text-tertiary); font-size: 13px; }

    /* ── Payment Modal ── */
    .modal-overlay {
        display: none; position: fixed; inset: 0; z-index: 1000;
        background: rgba(0,0,0,0.6); backdrop-filter: blur(6px);
        align-items: center; justify-content: center;
    }
    .modal-overlay.open { display: flex; }

    .modal-box {
        background: var(--card-bg); border: 0.5px solid var(--border);
        border-radius: 16px; width: min(460px, 94vw);
        box-shadow: 0 32px 80px rgba(0,0,0,0.4);
        animation: modalIn 0.25s cubic-bezier(0.22,1,0.36,1) both;
        overflow: hidden;
    }
    @keyframes modalIn {
        from { opacity: 0; transform: translateY(20px) scale(0.96); }
        to   { opacity: 1; transform: translateY(0) scale(1); }
    }

    .modal-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 20px; border-bottom: 0.5px solid var(--border);
    }
    .modal-title { font-size: 14px; font-weight: 600; color: var(--text-primary); }
    .modal-step-indicator {
        display: flex; gap: 6px; align-items: center;
    }
    .modal-step-dot {
        width: 6px; height: 6px; border-radius: 50%;
        background: var(--border); transition: background 0.2s;
    }
    .modal-step-dot.active { background: var(--accent-blue); width: 16px; border-radius: 3px; }
    .modal-step-dot.done   { background: var(--accent-green); }

    .modal-close {
        width: 28px; height: 28px; border-radius: 6px; border: none;
        background: var(--bg-secondary); color: var(--text-tertiary);
        font-size: 16px; cursor: pointer; display: flex; align-items: center;
        justify-content: center; transition: background 0.12s;
    }
    .modal-close:hover { background: var(--border); }

    /* Step panels */
    .modal-step { display: none; }
    .modal-step.active { display: block; }

    /* Step 1 — Summary */
    .modal-body { padding: 20px; display: flex; flex-direction: column; gap: 12px; }
    .modal-info-row {
        display: flex; justify-content: space-between; align-items: center; font-size: 13px;
    }
    .modal-info-label { color: var(--text-tertiary); }
    .modal-info-value { color: var(--text-primary); font-weight: 500; }
    .modal-divider { border: none; border-top: 0.5px solid var(--border); margin: 2px 0; }
    .modal-total-row { display: flex; justify-content: space-between; align-items: center; }
    .modal-total-label { font-size: 13px; font-weight: 600; color: var(--text-primary); }
    .modal-total-value { font-size: 20px; font-weight: 700; color: var(--accent-red); }

    /* Step 2 — QRIS */
    .qris-wrapper {
        padding: 20px; display: flex; flex-direction: column; align-items: center; gap: 14px;
    }
    .qris-label {
        font-size: 11px; font-weight: 600; color: var(--text-tertiary);
        text-transform: uppercase; letter-spacing: 0.1em;
    }
    .qris-card {
        background: #fff; border-radius: 12px; padding: 18px;
        display: flex; flex-direction: column; align-items: center; gap: 10px;
        width: 220px; box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        border: 1px solid #e8e8e8;
    }
    .qris-header-img { font-size: 11px; font-weight: 700; color: #E31E24; letter-spacing: 0.1em; }
    .qris-img { width: 160px; height: 160px; object-fit: contain; border-radius: 6px; }
    .qris-merchant { font-size: 11px; color: #555; font-weight: 600; text-align: center; }
    .qris-payment-logos {
        display: flex; gap: 8px; align-items: center; flex-wrap: wrap; justify-content: center;
    }
    .qris-logo-pill {
        background: var(--bg-secondary); border: 0.5px solid var(--border);
        border-radius: 5px; padding: 3px 8px;
        font-size: 10px; font-weight: 600; color: var(--text-secondary);
    }
    .qris-amount-display {
        text-align: center; padding: 10px 20px; background: var(--accent-red-bg);
        border-radius: 10px; width: 100%;
    }
    .qris-amount-label { font-size: 11px; color: var(--accent-red); }
    .qris-amount-value { font-size: 22px; font-weight: 700; color: var(--accent-red); }
    .qris-instruction {
        font-size: 12px; color: var(--text-secondary); text-align: center; line-height: 1.6;
    }
    .qris-timer {
        font-size: 12px; font-weight: 600; color: var(--accent-amber);
        background: var(--accent-amber-bg); padding: 5px 14px; border-radius: 20px;
    }

    /* Step 3 — Success */
    .success-wrapper {
        padding: 30px 20px; display: flex; flex-direction: column; align-items: center; gap: 14px;
        text-align: center;
    }
    .success-icon {
        width: 64px; height: 64px; border-radius: 50%;
        background: var(--accent-green-bg); display: flex; align-items: center; justify-content: center;
        animation: successPop 0.4s cubic-bezier(0.22,1,0.36,1) both;
    }
    @keyframes successPop {
        from { transform: scale(0.5); opacity: 0; }
        to   { transform: scale(1); opacity: 1; }
    }
    .success-icon svg { width: 32px; height: 32px; color: var(--accent-green); }
    .success-title { font-size: 16px; font-weight: 700; color: var(--text-primary); }
    .success-sub   { font-size: 13px; color: var(--text-secondary); max-width: 300px; }

    /* Modal footer */
    .modal-footer-ctrl { padding: 0 20px 20px; display: flex; gap: 8px; }
    .btn-cancel {
        flex: 1; padding: 9px; border-radius: 8px; border: 0.5px solid var(--border);
        background: var(--bg-secondary); color: var(--text-secondary);
        font-size: 13px; font-weight: 500; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: background 0.12s;
    }
    .btn-cancel:hover { background: var(--border); }
    .btn-primary-modal {
        flex: 2; padding: 9px; border-radius: 8px; border: none;
        background: var(--accent-blue); color: #fff;
        font-size: 13px; font-weight: 600; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: opacity 0.12s;
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    }
    .btn-primary-modal:hover { opacity: 0.85; }
    .btn-success-modal {
        flex: 2; padding: 9px; border-radius: 8px; border: none;
        background: var(--accent-green); color: #fff;
        font-size: 13px; font-weight: 600; cursor: pointer;
        font-family: 'DM Sans', sans-serif; transition: opacity 0.12s;
        display: inline-flex; align-items: center; justify-content: center; gap: 6px;
    }
    .btn-success-modal:hover { opacity: 0.85; }

    /* Summary & Filter Area */
    .summary-cards {
        display: flex; gap: 15px; margin-bottom: 20px; flex-wrap: wrap;
    }
    .summary-card {
        background: var(--card-bg); border: 0.5px solid var(--border);
        border-radius: 12px; padding: 15px 20px; display: flex; align-items: center; gap: 15px;
        flex: 1; min-width: 250px; box-shadow: 0 4px 12px rgba(0,0,0,0.02);
    }
    .summary-icon {
        width: 48px; height: 48px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-size: 20px;
    }
    .summary-icon.terlambat { background: var(--accent-red-bg); color: var(--accent-red); }
    .summary-icon.denda { background: var(--accent-amber-bg); color: var(--accent-amber); }
    .summary-info h6 {
        font-size: 13px; color: var(--text-secondary); margin: 0 0 5px; font-weight: 500;
    }
    .summary-info h3 {
        font-size: 20px; font-weight: 700; color: var(--text-primary); margin: 0;
    }
    .filter-pills {
        display: flex; gap: 10px; margin-bottom: 5px; overflow-x: auto; padding-bottom: 10px;
    }
    .filter-pill {
        padding: 6px 14px; border-radius: 20px; border: 0.5px solid var(--border);
        background: var(--card-bg); color: var(--text-secondary);
        font-size: 12px; font-weight: 600; cursor: pointer; transition: all 0.2s; white-space: nowrap;
    }
    .filter-pill.active {
        background: var(--accent-blue); border-color: var(--accent-blue); color: #fff;
    }
    .filter-pill:hover:not(.active) {
        background: var(--bg-hover); color: var(--text-primary);
    }
</style>

<div class="page-card">
    <div class="page-card-header">
        <div class="page-card-title">Data Peminjaman</div>
        <div class="header-actions">
            <input type="text" id="searchInput" class="search-input" placeholder="Cari peminjaman...">
            <a href="{{ route('peminjamans.add') }}" class="add-btn">
                <i class="bi bi-plus"></i> Tambah Peminjaman
            </a>
        </div>
    </div>

    <div style="padding: 0 24px 15px;">
        <div class="summary-cards">
            <div class="summary-card">
                <div class="summary-icon terlambat"><i class="bi bi-clock-history"></i></div>
                <div class="summary-info">
                    <h6>Siswa Terlambat Mengembalikan</h6>
                    <h3>{{ $totalSiswaTerlambat }} Orang</h3>
                </div>
            </div>
            <div class="summary-card">
                <div class="summary-icon denda"><i class="bi bi-wallet2"></i></div>
                <div class="summary-info">
                    <h6>Total Denda Terkumpul / Belum Lunas</h6>
                    <h3>Rp {{ number_format($totalDenda, 0, ',', '.') }}</h3>
                </div>
            </div>
        </div>

        <div class="filter-pills">
            <button class="filter-pill active" onclick="window.filterTable('semua', this)">Semua Data</button>
            <button class="filter-pill" onclick="window.filterTable('terlambat', this)">Terlambat Mengembalikan</button>
            <button class="filter-pill" onclick="window.filterTable('selesai', this)">Selesai Diurus (Lunas/Dikembalikan)</button>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="tbl">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Siswa</th>
                    <th>Buku</th>
                    <th>Total Buku</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjaman as $p)
                @php
                    $dendaPerHari = (int) (\App\Models\Setting::where('key', 'denda_per_hari')->value('value') ?? 1000);
                    $today        = \Carbon\Carbon::today();
                    $deadline     = $p->tanggal_kembali ? \Carbon\Carbon::parse($p->tanggal_kembali) : null;
                    $statusText   = ucwords($p->status);
                    $statusClass  = 'status-dipinjam';
                    $hariTelat    = 0;
                    $totalDenda   = 0;
                    $isTerlambat  = false;
                    $dendaLunas   = (bool)($p->denda_lunas ?? false);

                    $isActiveMode = in_array(strtolower($p->status), ['dipinjam', 'sebagian dikembalikan']);

                    if ($isActiveMode) {
                        if ($deadline && $today->gt($deadline)) {
                            // Overdue: calculate fine. Use abs() to prevent negative values.
                            $hariTelat   = (int)abs($today->diffInDays($deadline));
                            $jumlahBuku  = $p->jumlah_buku ?? 1;
                            $totalDenda  = $hariTelat * $dendaPerHari * $jumlahBuku;
                            $isTerlambat = true;
                            $statusText  = 'Terlambat (' . $hariTelat . ' hari)';
                            $statusClass = 'status-terlambat';
                        } elseif (strtolower($p->status) === 'sebagian dikembalikan') {
                            $statusText  = 'Sebagian Dikembalikan';
                            $statusClass = 'status-info';
                        } else {
                            $statusText  = 'Dipinjam';
                            $statusClass = 'status-dipinjam';
                        }
                    } elseif (str_contains(strtolower($p->status), 'kembali')) {
                        $statusClass = 'status-kembali';
                        $statusText  = 'Dikembalikan';
                    }
                @endphp
                <tr data-terlambat="{{ $isTerlambat ? 'true' : 'false' }}" data-selesai="{{ strtolower($p->status) === 'dikembalikan' ? 'true' : 'false' }}">
                    <td><span class="id-badge">{{ $loop->iteration }}</span></td>
                    <td style="font-weight:500;">{{ optional($p->siswa)->nama ?? '-' }}</td>
                    <td>{{ optional($p->buku)->judul ?? '-' }}</td>
                    <td style="text-align:center; font-weight:600; color:var(--text-secondary);">{{ $p->jumlah_buku ?? 1 }}</td>
                    <td style="color: var(--text-secondary);">{{ $p->tanggal_pinjam }}</td>
                    <td style="color: var(--text-secondary);">{{ $p->tanggal_kembali ?? '-' }}</td>
                    <td><span class="status-badge {{ $statusClass }}">{{ $statusText }}</span></td>

                    {{-- Denda --}}
                    <td>
                        <div class="denda-cell">
                            @if($isTerlambat && !$dendaLunas)
                                <span class="denda-amount">
                                    Rp {{ number_format($totalDenda, 0, ',', '.') }}
                                </span>
                                {{-- Tombol bayar denda --}}
                                <button
                                    class="btn-bayar"
                                    title="Bayar Denda via QRIS"
                                    onclick="openBayarModal({
                                        id: {{ $p->id }},
                                        siswa: '{{ addslashes(optional($p->siswa)->nama ?? '-') }}',
                                        buku: '{{ addslashes(optional($p->buku)->judul ?? '-') }}',
                                        hari: {{ $hariTelat }},
                                        denda: {{ $totalDenda }},
                                        dendaFmt: 'Rp {{ number_format($totalDenda, 0, ',', '.') }}'
                                    })"
                                >
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="2" y="7" width="20" height="14" rx="2"/>
                                        <path d="M16 3H8L2 7h20l-6-4z"/>
                                        <circle cx="16" cy="14" r="1.5" fill="currentColor" stroke="none"/>
                                    </svg>
                                </button>
                            @elseif($dendaLunas)
                                <span class="denda-lunas">✓ Lunas</span>
                            @elseif(!$isActiveMode)
                                <span class="denda-none">—</span>
                            @else
                                <span class="denda-none">—</span>
                            @endif
                        </div>
                    </td>

                    <td>
                        <div class="row-actions">
                            <a href="{{ route('peminjamans.edit', $p->id) }}" class="act-edit">Edit</a>
                            <form action="{{ route('peminjamans.delete', $p->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="button" class="act-del" style="background:none; border:none; padding:0; cursor:pointer; font-family:inherit;"
                                    onclick="confirmDelete(this.closest('form'), '{{ addslashes((optional($p->siswa)->nama ?? '-') . ' – ' . (optional($p->buku)->judul ?? '-')) }}')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="9">Tidak ada data peminjaman.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($peminjaman->hasPages())
    <div style="padding: 14px 20px; border-top: 0.5px solid var(--border); display: flex; justify-content: center;">
        {{ $peminjaman->links() }}
    </div>
    @endif
</div>

{{-- ── Multi-step Payment Modal ── --}}
<div class="modal-overlay" id="modalBayar">
    <div class="modal-box">

        {{-- Header --}}
        <div class="modal-header">
            <span class="modal-title" id="modalTitle">Pembayaran Denda</span>
            <div style="display:flex; align-items:center; gap:10px;">
                <div class="modal-step-indicator">
                    <div class="modal-step-dot active" id="dot1"></div>
                    <div class="modal-step-dot" id="dot2"></div>
                    <div class="modal-step-dot" id="dot3"></div>
                </div>
                <button class="modal-close" onclick="closeModal()">&#x2715;</button>
            </div>
        </div>

        {{-- ── Step 1: Summary ── --}}
        <div class="modal-step active" id="step1">
            <div class="modal-body">
                <div class="modal-info-row">
                    <span class="modal-info-label">Siswa</span>
                    <span class="modal-info-value" id="m-siswa">—</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Buku</span>
                    <span class="modal-info-value" id="m-buku">—</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Keterlambatan</span>
                    <span class="modal-info-value" id="m-hari">—</span>
                </div>
                <div class="modal-info-row">
                    <span class="modal-info-label">Tarif denda</span>
                    <span class="modal-info-value">Rp 1.000 / hari</span>
                </div>
                <hr class="modal-divider">
                <div class="modal-total-row">
                    <span class="modal-total-label">Total Denda</span>
                    <span class="modal-total-value" id="m-total">—</span>
                </div>
            </div>
            <div class="modal-footer-ctrl">
                <button class="btn-cancel" onclick="closeModal()">Batal</button>
                <button class="btn-primary-modal" onclick="goToStep(2)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/>
                    </svg>
                    Bayar via QRIS
                </button>
            </div>
        </div>

        {{-- ── Step 2: QRIS ── --}}
        <div class="modal-step" id="step2">
            <div class="qris-wrapper">
                <div class="qris-label">Scan & Bayar dengan QRIS</div>

                <div class="qris-card">
                    <div class="qris-header-img">&#9632; QRIS</div>
                    {{-- QR code image generated --}}
                    <img src="{{ asset('images/qris.png') }}"
                         onerror="this.style.display='none'; document.getElementById('qris-fallback').style.display='flex';"
                         class="qris-img" alt="QRIS Payment Code">
                    {{-- Fallback QR SVG if image missing (hidden by default) --}}
                    <div id="qris-fallback" style="display:none; width:160px; height:160px; background:#f0f0f0; border-radius:6px; align-items:center; justify-content:center; flex-direction:column; gap:6px;">
                        <svg viewBox="0 0 160 160" width="140" height="140" style="opacity:0.9;">
                            <!-- QR border squares -->
                            <rect x="10" y="10" width="50" height="50" fill="none" stroke="#000" stroke-width="5"/>
                            <rect x="20" y="20" width="30" height="30" fill="#000"/>
                            <rect x="100" y="10" width="50" height="50" fill="none" stroke="#000" stroke-width="5"/>
                            <rect x="110" y="20" width="30" height="30" fill="#000"/>
                            <rect x="10" y="100" width="50" height="50" fill="none" stroke="#000" stroke-width="5"/>
                            <rect x="20" y="110" width="30" height="30" fill="#000"/>
                            <!-- QR data dots -->
                            <rect x="70" y="10" width="10" height="10" fill="#000"/>
                            <rect x="80" y="20" width="10" height="10" fill="#000"/>
                            <rect x="70" y="30" width="10" height="10" fill="#000"/>
                            <rect x="90" y="10" width="10" height="10" fill="#000"/>
                            <rect x="70" y="70" width="10" height="10" fill="#000"/>
                            <rect x="80" y="80" width="10" height="10" fill="#000"/>
                            <rect x="90" y="70" width="10" height="10" fill="#000"/>
                            <rect x="100" y="80" width="10" height="10" fill="#000"/>
                            <rect x="110" y="70" width="10" height="10" fill="#000"/>
                            <rect x="70" y="90" width="10" height="10" fill="#000"/>
                            <rect x="80" y="100" width="10" height="10" fill="#000"/>
                            <rect x="90" y="90" width="10" height="10" fill="#000"/>
                            <rect x="100" y="100" width="10" height="10" fill="#000"/>
                            <rect x="120" y="100" width="10" height="10" fill="#000"/>
                            <rect x="130" y="110" width="10" height="10" fill="#000"/>
                            <rect x="140" y="100" width="10" height="10" fill="#000"/>
                            <rect x="70" y="110" width="10" height="10" fill="#000"/>
                            <rect x="80" y="120" width="10" height="10" fill="#000"/>
                            <rect x="70" y="130" width="10" height="10" fill="#000"/>
                            <rect x="90" y="140" width="10" height="10" fill="#000"/>
                        </svg>
                    </div>
                    <div class="qris-merchant">Perpustakaan Digital</div>
                </div>

                <div class="qris-amount-display">
                    <div class="qris-amount-label">Total Pembayaran</div>
                    <div class="qris-amount-value" id="m-total-qris">—</div>
                </div>

                <div class="qris-payment-logos">
                    <span class="qris-logo-pill">GoPay</span>
                    <span class="qris-logo-pill">OVO</span>
                    <span class="qris-logo-pill">Dana</span>
                    <span class="qris-logo-pill">ShopeePay</span>
                    <span class="qris-logo-pill">LinkAja</span>
                    <span class="qris-logo-pill">m-BCA</span>
                </div>

                <div class="qris-instruction">
                    Buka aplikasi e-wallet atau mobile banking, lalu pilih<br>
                    <strong>Scan QR / QRIS</strong> dan arahkan ke kode di atas.
                </div>

                <div class="qris-timer" id="qrisTimer">⏱ Menunggu pembayaran...</div>
            </div>
            <div class="modal-footer-ctrl">
                <button class="btn-cancel" onclick="goToStep(1)">← Kembali</button>
                <button class="btn-success-modal" onclick="goToStep(3)">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Konfirmasi Sudah Bayar
                </button>
            </div>
        </div>

        {{-- ── Step 3: Success ── --}}
        <div class="modal-step" id="step3">
            <div class="success-wrapper">
                <div class="success-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="color:var(--accent-green);">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                </div>
                <div class="success-title">Pembayaran Dikonfirmasi!</div>
                <div class="success-sub">Denda atas nama <strong id="m-siswa-success">—</strong> sebesar <strong id="m-total-success">—</strong> telah berhasil dicatat sebagai lunas.</div>
            </div>
            <div class="modal-footer-ctrl">
                <button class="btn-cancel" onclick="closeModal()">Tutup</button>
                <form id="formBayar" method="POST" style="flex:2; display:flex;">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn-success-modal" style="width:100%;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Simpan & Selesai
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    let currentStep = 1;
    let timerInterval = null;
    let timerSeconds = 300; // 5 min countdown

    function openBayarModal(data) {
        document.getElementById('m-siswa').textContent       = data.siswa;
        document.getElementById('m-buku').textContent        = data.buku;
        document.getElementById('m-hari').textContent        = data.hari + ' hari';
        document.getElementById('m-total').textContent       = data.dendaFmt;
        document.getElementById('m-total-qris').textContent  = data.dendaFmt;
        document.getElementById('m-siswa-success').textContent = data.siswa;
        document.getElementById('m-total-success').textContent = data.dendaFmt;
        document.getElementById('formBayar').action = '/peminjamans/' + data.id + '/bayar-denda';

        goToStep(1);
        document.getElementById('modalBayar').classList.add('open');
    }

    function goToStep(n) {
        // Hide all steps
        document.querySelectorAll('.modal-step').forEach(el => el.classList.remove('active'));
        document.getElementById('step' + n).classList.add('active');

        // Update dots
        ['dot1','dot2','dot3'].forEach((id, i) => {
            const dot = document.getElementById(id);
            dot.classList.remove('active','done');
            if (i + 1 < n) dot.classList.add('done');
            else if (i + 1 === n) dot.classList.add('active');
        });

        // Titles
        const titles = {1: 'Rincian Denda', 2: 'Scan QRIS', 3: 'Pembayaran Sukses'};
        document.getElementById('modalTitle').textContent = titles[n] || 'Pembayaran Denda';

        currentStep = n;

        // Timer for step 2
        if (n === 2) {
            startTimer();
        } else {
            stopTimer();
        }
    }

    function startTimer() {
        stopTimer();
        timerSeconds = 300;
        updateTimerDisplay();
        timerInterval = setInterval(() => {
            timerSeconds--;
            updateTimerDisplay();
            if (timerSeconds <= 0) {
                stopTimer();
                document.getElementById('qrisTimer').textContent = '⏱ Waktu habis. Silakan muat ulang halaman.';
            }
        }, 1000);
    }

    function stopTimer() {
        if (timerInterval) { clearInterval(timerInterval); timerInterval = null; }
    }

    function updateTimerDisplay() {
        const m = String(Math.floor(timerSeconds / 60)).padStart(2,'0');
        const s = String(timerSeconds % 60).padStart(2,'0');
        const el = document.getElementById('qrisTimer');
        if (el) el.textContent = '⏱ Kode berlaku: ' + m + ':' + s;
    }

    function closeModal() {
        stopTimer();
        document.getElementById('modalBayar').classList.remove('open');
    }

    // Close on overlay click
    document.getElementById('modalBayar').addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });

    // Search & Tab Filter
    let currentFilter = 'semua';
    window.filterTable = function(type, btn) {
        currentFilter = type;
        document.querySelectorAll('.filter-pill').forEach(el => el.classList.remove('active'));
        btn.classList.add('active');
        applyFilters();
    };

    document.getElementById('searchInput').addEventListener('input', applyFilters);

    function applyFilters() {
        const q = (document.getElementById('searchInput')?.value || '').toLowerCase();
        document.querySelectorAll('.tbl tbody tr:not(.empty-row)').forEach(row => {
            const matchQ = row.textContent.toLowerCase().includes(q);
            let matchT = true;
            if (currentFilter === 'terlambat') {
                matchT = row.getAttribute('data-terlambat') === 'true';
            } else if (currentFilter === 'selesai') {
                matchT = row.getAttribute('data-selesai') === 'true';
            }
            row.style.display = (matchQ && matchT) ? '' : 'none';
        });
    }
</script>

@endsection