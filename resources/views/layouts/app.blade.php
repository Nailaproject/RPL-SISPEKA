<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>SISPEKA</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fb;
        }
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: #ffffff;
            border-right: 1px solid #e5e6eb;
        }
        .sidebar-title {
            color: #116ccd;
            font-size: 15px;
            font-weight: 600;
        }
        .sidebar .nav-link {
            color: #0c0c86;
            font-size: 15px;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: rgba(15, 7, 128, 0.15);
            color: #0c4786;
        }
        .content-area {
            padding: 25px;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-dark bg-primary px-3">
    <span class="navbar-brand fw-bold">SISPEKA</span>

    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button class="btn btn-light btn-sm">Logout</button>
    </form>
    @endauth
</nav>

<div class="d-flex">
<!-- SIDEBAR -->
<aside class="sidebar p-3">

    <h6 class="sidebar-title text-uppercase mb-3">Menu</h6>

    {{-- ================= ADMIN ================= --}}
    @if(auth()->user()->role === 'admin')

        <ul class="nav nav-pills flex-column mb-3">
            <li class="nav-item mb-2">
                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
        </ul>

        <h6 class="sidebar-title text-uppercase mb-2">Master Data</h6>
        <ul class="nav nav-pills flex-column mb-3">
            <li class="nav-item mb-2">
                <a href="{{ route('admin.guru.index') }}"
                   class="nav-link {{ request()->routeIs('admin.guru.*') ? 'active' : '' }}">
                    <i class="bi bi-person-workspace me-2"></i> Guru
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('admin.siswa.index') }}"
                   class="nav-link {{ request()->routeIs('admin.siswa.*') ? 'active' : '' }}">
                    <i class="bi bi-people-fill me-2"></i> Siswa
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('admin.kelas.index') }}"
                   class="nav-link {{ request()->routeIs('admin.kelas.*') ? 'active' : '' }}">
                    <i class="bi bi-door-open me-2"></i> Kelas
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('admin.subject.index') }}"
                   class="nav-link {{ request()->routeIs('admin.subject.*') ? 'active' : '' }}">
                    <i class="bi bi-book-fill me-2"></i> Mata Pelajaran
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('admin.teaching.index') }}"
                   class="nav-link {{ request()->routeIs('admin.teaching.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-check me-2"></i> Penugasan Mengajar
                </a>
            </li>
        </ul>

    {{-- ================= GURU ================= --}}
    @elseif(auth()->user()->role === 'guru')

        <ul class="nav nav-pills flex-column mb-3">
            <li class="nav-item mb-2">
                <a href="{{ route('guru.dashboard') }}"
                   class="nav-link {{ request()->routeIs('guru.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
        </ul>

        <h6 class="sidebar-title text-uppercase mb-2">Akademik</h6>
        <ul class="nav nav-pills flex-column mb-3">
            <li class="nav-item mb-2">
                <a href="{{ route('guru.attendance.index') }}"
                   class="nav-link {{ request()->routeIs('attendance.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check me-2"></i> Kehadiran
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('guru.grade.index') }}"
                   class="nav-link {{ request()->routeIs('grade.*') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-fill me-2"></i> Nilai
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('guru.laporan.index') }}"
                   class="nav-link {{ request()->routeIs('laporan.*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text me-2"></i> Catatan Perilaku
                </a>
            </li>
        </ul>

    {{-- ================= WALI ================= --}}
    @elseif(auth()->user()->role === 'wali')

        <ul class="nav nav-pills flex-column mb-3">
            <li class="nav-item mb-2">
                <a href="{{ route('wali.dashboard') }}"
                   class="nav-link {{ request()->routeIs('wali.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>
        </ul>

        <h6 class="sidebar-title text-uppercase mb-2">Informasi Siswa</h6>
        <ul class="nav nav-pills flex-column">
            <li class="nav-item mb-2">
                <a href="{{ route('wali.attendance') }}"
                   class="nav-link {{ request()->routeIs('wali.attendance') ? 'active' : '' }}">
                    <i class="bi bi-calendar-check me-2"></i> Kehadiran
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('wali.grade') }}"
                   class="nav-link {{ request()->routeIs('wali.grade') ? 'active' : '' }}">
                    <i class="bi bi-bar-chart-fill me-2"></i> Nilai
                </a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('wali.laporan') }}"
                   class="nav-link {{ request()->routeIs('wali.laporan') ? 'active' : '' }}">
                    <i class="bi bi-journal-text me-2"></i> Laporan Siswa
                </a>
            </li>
        </ul>

    @endif

</aside>

    <!-- CONTENT -->
    <main class="flex-fill content-area">
        @yield('content')
    </main>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
