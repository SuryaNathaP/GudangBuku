@extends('layout.master')

@section('title', 'Users')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 fw-bold">Data Users</h5>
            <div class="d-flex gap-2">
                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Cari user...">
                <a href="{{ route('users.add') }}" class="btn btn-primary btn-sm text-nowrap">
                    + Add User
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0 align-middle">
                    <thead class="text-uppercase small">
                        <tr>
                            <th scope="col" class="px-3 py-3">ID</th>
                            <th scope="col" class="px-3 py-3">Name</th>
                            <th scope="col" class="px-3 py-3">Email</th>
                            <th scope="col" class="px-3 py-3">Role</th>
                            <th scope="col" class="px-3 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="px-3 py-3 fw-medium">
                                    {{ $user->id }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $user->name }}
                                </td>
                                <td class="px-3 py-3">
                                    {{ $user->email }}
                                </td>
                                <td class="px-3 py-3">
                                    <span
                                        class="badge rounded-pill 
                                        {{ $user->role === 'admin' ? 'bg-primary' : ($user->role === 'petugas' ? 'bg-info' : 'bg-secondary') }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="text-decoration-none text-primary fw-medium">Edit</a>
                                        <form action="{{ route('users.delete', $user->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="button" class="text-decoration-none text-danger fw-medium" style="background:none; border:none; padding:0; cursor:pointer;"
                                                onclick="confirmDelete(this.closest('form'), '{{ addslashes($user->name) }}')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-3 py-4 text-center text-muted">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($users->hasPages())
        <div class="card-footer bg-transparent p-3 border-top-0" style="border-color: var(--border) !important;">
            {{ $users->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
@endsection
