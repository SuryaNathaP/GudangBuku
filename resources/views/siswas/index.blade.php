@extends('layout.master')

@section('title', 'Data Siswa')

@section('content')

<style>
    .page-card {
        background: var(--card-bg);
        border: 0.5px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
    }
    .page-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 0.5px solid var(--border);
        gap: 12px;
    }
    .page-card-title { font-size: 14px; font-weight: 500; color: var(--text-primary); }
    .header-actions { display: flex; align-items: center; gap: 8px; }

    .search-input {
        background: var(--input-bg) !important;
        border: 0.5px solid var(--border) !important;
        border-radius: 8px !important;
        color: var(--text-primary) !important;
        font-size: 12.5px !important;
        font-family: 'DM Sans', sans-serif !important;
        padding: 6px 12px !important;
        width: 200px;
        outline: none;
    }
    .search-input:focus { border-color: var(--accent-blue) !important; box-shadow: 0 0 0 3px rgba(24,95,165,0.1) !important; }
    .search-input::placeholder { color: var(--text-tertiary) !important; }

    .add-btn {
        background: var(--accent-blue);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 500;
        padding: 6px 14px;
        font-family: 'DM Sans', sans-serif;
        white-space: nowrap;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex; align-items: center; gap: 5px;
        transition: background 0.12s;
    }
    .add-btn:hover { background: #0C447C; color: #fff; }

    .tbl { width: 100%; border-collapse: collapse; }
    .tbl thead th {
        background: var(--bg-secondary);
        color: var(--text-tertiary);
        font-size: 10.5px;
        letter-spacing: 0.07em;
        font-weight: 500;
        text-transform: uppercase;
        padding: 10px 16px;
        border-bottom: 0.5px solid var(--border);
        white-space: nowrap;
    }
    .tbl tbody td {
        padding: 12px 16px;
        color: var(--text-primary);
        font-size: 13.5px;
        border-bottom: 0.5px solid var(--border);
    }
    .tbl tbody tr:last-child td { border-bottom: none; }
    .tbl tbody tr:hover td { background: var(--table-hover); }

    .id-badge {
        display: inline-block;
        background: var(--bg-secondary);
        color: var(--text-tertiary);
        font-size: 11px; font-weight: 500;
        padding: 2px 7px; border-radius: 5px;
        font-family: monospace;
    }

    .row-actions { display: flex; align-items: center; gap: 12px; }
    .act-edit { color: var(--accent-blue); font-size: 13px; font-weight: 500; transition: opacity 0.12s; }
    .act-edit:hover { opacity: 0.7; color: var(--accent-blue); }
    .act-del  { color: var(--accent-red); font-size: 13px; font-weight: 500; transition: opacity 0.12s; }
    .act-del:hover  { opacity: 0.7; color: var(--accent-red); }

    .empty-row td { padding: 40px 16px !important; text-align: center; color: var(--text-tertiary); font-size: 13px; }
</style>

<div class="page-card">
    <div class="page-card-header">
        <div class="page-card-title">Data Siswa</div>
        <div class="header-actions">
            <input type="text" id="searchInput" class="search-input" placeholder="Cari siswa...">
            <a href="{{ route('siswas.add') }}" class="add-btn">
                <i class="bi bi-plus"></i> Add Siswa
            </a>
        </div>
    </div>

    <div style="overflow-x: auto;">
        <table class="tbl">
            <thead>
                <tr>
                    <th>NO</th>
                    <th>Nama</th>
                    <th>NIS</th>
                    <th>Kelas</th>
                    <th>Jurusan</th>
                    <th style="text-align:center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $s)
                <tr>
                    <td><span class="id-badge">{{ $siswa->firstItem() + $loop->index }}</span></td>
                    <td style="font-weight:500;">{{ $s->nama }}</td>
                    <td>{{ $s->nis }}</td>
                    <td>{{ $s->kelas }}</td>
                    <td>{{ $s->jurusan }}</td>
                    <td>
                        <div class="row-actions" style="justify-content:center;">
                            <a href="{{ route('siswas.edit', $s->id) }}" class="act-edit">Edit</a>
                            <form action="{{ route('siswas.delete', $s->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="button" class="act-del" style="background:none; border:none; padding:0; cursor:pointer; font-family:inherit;"
                                    onclick="confirmDelete(this.closest('form'), '{{ addslashes($s->nama) }}')">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="empty-row"><td colspan="6">Tidak ada data siswa.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($siswa->hasPages())
    <div class="p-3 border-top" style="border-color: var(--border) !important;">
        {{ $siswa->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection
