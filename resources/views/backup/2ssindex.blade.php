@extends('layout.master')

@section('title', 'Data Siswa')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">Data Siswa</h5>
            <div class="d-flex gap-2">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari siswa...">
                <a href="{{ route('siswas.add') }}" class="btn btn-primary btn-sm text-nowrap">
                    + Add Siswa
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="text-uppercase small">
                        <tr>
                            <th scope="col" class="px-3 py-3">ID</th>
                            <th scope="col" class="px-3 py-3">Nama</th>
                            <th scope="col" class="px-3 py-3">NIS</th>
                            <th scope="col" class="px-3 py-3">Kelas</th>
                            <th scope="col" class="px-3 py-3">Jurusan</th>
                            <th scope="col" class="px-3 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $s)
                            <tr>
                                <td class="px-3 py-3 fw-medium">
                                    {{ $s->id }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $s->nama }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $s->nis }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $s->kelas }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $s->jurusan }}
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('siswas.edit', $s->id) }}"
                                            class="text-decoration-none text-primary fw-medium">Edit</a>
                                        <a href="{{ route('siswas.delete', $s->id) }}"
                                            class="text-decoration-none text-danger fw-medium"
                                            onclick="return confirm('Are you sure you want to delete this siswa?')">Delete</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-4 text-center text-muted">
                                    No siswa found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
