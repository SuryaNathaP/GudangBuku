@extends('layout.master')

@section('title', 'Add User')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h5 class="mb-0 fw-bold">Add New User</h5>
                </div>
                
                <div class="card-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
    
                        <div class="mb-3">
                            <label for="id" class="form-label">ID (Manual)</label>
                            <input type="text" id="id" name="id" class="form-control" placeholder="Enter ID" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="name@example.com" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
    
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="" disabled selected>Select Role</option>
                                <option value="admin">Admin</option>
                                <option value="petugas">Petugas</option>
                            </select>
                        </div>
    
                        <div class="mt-4 d-flex gap-2">
                            <button type="submit" class="btn btn-primary">Save User</button>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
