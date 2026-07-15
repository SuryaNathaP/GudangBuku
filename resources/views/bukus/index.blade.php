@extends('layout.master')

@section('title', 'Daftar Buku')

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
    .cat-badge { display: inline-block; background: var(--accent-blue-bg); color: var(--accent-blue-txt); font-size: 11px; font-weight: 500; padding: 3px 9px; border-radius: 6px; }
    .stok-ok  { color: var(--accent-green); font-weight: 600; }
    .stok-out { color: var(--accent-red); font-weight: 600; }
    .row-actions { display: flex; align-items: center; gap: 12px; justify-content: center; }
    .act-edit { color: var(--accent-blue); font-size: 13px; font-weight: 500; }
    .act-edit:hover { opacity: 0.7; color: var(--accent-blue); }
    .act-del  { color: var(--accent-red);  font-size: 13px; font-weight: 500; }
    .act-del:hover  { opacity: 0.7; color: var(--accent-red); }
    .empty-row td { padding: 40px 16px !important; text-align: center; color: var(--text-tertiary); font-size: 13px; }
</style>

<div class="page-card">
    <div class="page-card-header">
        <div class="page-card-title">Data Buku</div>
        <div class="header-actions">
            <input type="text" id="searchInput" class="search-input" placeholder="Cari buku...">
            <a href="{{ route('bukus.add') }}" class="add-btn">
                <i class="bi bi-plus"></i> Tambah Buku
            </a>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="tbl">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun</th>
                    <th>Kategori</th>
                    <th>Rak</th>
                    <th>Stok</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bukus as $bukuItem)
                <tr>
                    <td><span class="id-badge">{{ $bukus->firstItem() + $loop->index }}</span></td>
                    <td style="font-weight:500;">{{ $bukuItem->judul }}</td>
                    <td style="color: var(--text-secondary);">{{ $bukuItem->penulis }}</td>
                    <td style="color: var(--text-secondary);">{{ $bukuItem->tahun_terbit }}</td>
                    <td>
                        <span class="cat-badge">{{ optional($bukuItem->kategori)->nama_kategori ?? '-' }}</span>
                    </td>
                    <td style="color: var(--text-secondary);">
                        {{ $bukuItem->rak ?? '-' }}
                    </td>
                    <td>
                        <span class="{{ $bukuItem->stok > 0 ? 'stok-ok' : 'stok-out' }}">{{ $bukuItem->stok }}</span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a href="{{ route('bukus.edit', $bukuItem->id) }}" class="act-edit">Edit</a>
                            <form action="{{ route('bukus.delete', $bukuItem->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="button" class="act-del" style="background:none; border:none; padding:0; cursor:pointer; font-family:inherit;"
                                    onclick="confirmDelete(this.closest('form'), '{{ addslashes($bukuItem->judul) }}')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="8">Tidak ada data buku.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($bukus->hasPages())
    <div class="p-3 border-top" style="border-color: var(--border) !important;">
        {{ $bukus->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection
