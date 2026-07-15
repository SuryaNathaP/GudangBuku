<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
    <style>
        /* Custom styles to mimic sticky sidebar in Bootstrap */
        .sidebar {
            height: 100vh;
            position: sticky;
            top: 0;
            overflow-y: auto;
        }
        main {
            min-height: 100vh;
        }
    </style>
</head>
<body class="bg-light">

    <div class="row g-0">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 d-none d-md-block bg-dark text-white sidebar p-3">
            <a href="{{ route('dashboard') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-4 fw-bold">Perpustakaan</span>
            </a>
            <hr>
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'text-white' }}" aria-current="page">
                        <i class="bi bi-speedometer2 me-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('siswas.index') }}" class="nav-link {{ request()->routeIs('siswas.*') ? 'active' : 'text-white' }}">
                        <i class="bi bi-people me-2"></i>
                        Siswa
                    </a>
                </li>
                <li>
                    <a href="{{ route('bukus.index') }}" class="nav-link {{ request()->routeIs('bukus.*') ? 'active' : 'text-white' }}">
                        <i class="bi bi-book me-2"></i>
                        Buku
                    </a>
                </li>
                <li>
                    <a href="{{ route('kategoris.index') }}" class="nav-link {{ request()->routeIs('kategoris.*') ? 'active' : 'text-white' }}">
                        <i class="bi bi-tags me-2"></i>
                        Kategori
                    </a>
                </li>
                <li>
                    <a href="{{ route('peminjamans.index') }}" class="nav-link {{ request()->routeIs('peminjamans.*') ? 'active' : 'text-white' }}">
                        <i class="bi bi-arrow-left-right me-2"></i>
                        Peminjaman
                    </a>
                </li>
                <li>
                    <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : 'text-white' }}">
                        <i class="bi bi-person-badge me-2"></i>
                        Users
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-0">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm px-4 py-3">
                <div class="container-fluid">
                    <!-- Mobile Menu Toggle -->
                    <button class="btn btn-outline-secondary d-md-none me-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="bi bi-list"></i>
                    </button>

                   <h4 class="mb-0 text-dark fw-bold">{{ $title ?? 'Dashboard' }}</h4>
                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown">
                            <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="dropdownUserTop" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center me-2 text-white" style="width: 32px; height: 32px;">
                                    {{ auth()->user()->initials() ?? '?' }}
                                </div>
                                <span class="fw-medium d-none d-md-inline">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="dropdownUserTop">
                                <li><a class="dropdown-item" href="{{ route('settings.profile.edit') }}">Settings</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Sign out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Mobile Menu -->
            <div class="collapse d-md-none bg-white border-bottom p-3" id="mobileMenu">
                 <ul class="nav nav-pills flex-column">
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : 'text-dark' }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('siswas.index') }}" class="nav-link {{ request()->routeIs('siswas.*') ? 'active' : 'text-dark' }}">Siswa</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('bukus.index') }}" class="nav-link {{ request()->routeIs('bukus.*') ? 'active' : 'text-dark' }}">Buku</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('kategoris.index') }}" class="nav-link {{ request()->routeIs('kategoris.*') ? 'active' : 'text-dark' }}">Kategori</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('peminjamans.index') }}" class="nav-link {{ request()->routeIs('peminjamans.*') ? 'active' : 'text-dark' }}">Peminjaman</a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ route('users.index') }}" class="nav-link {{ request()->routeIs('users.*') ? 'active' : 'text-dark' }}">Users</a>
                    </li>
                </ul>
            </div>

            <main class="p-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
