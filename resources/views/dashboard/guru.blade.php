@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <h3 class="fw-bold text-primary mb-3">Dashboard Guru</h3>
    <p class="text-muted mb-4">
        Selamat datang, <strong>{{ auth()->user()->name }}</strong>
    </p>

    <div class="row g-3">

        {{-- Kehadiran --}}
        <div class="col-md-4">
            <a href="{{ route('guru.attendance.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 bg-primary text-white h-100">
                    <div class="card-body">
                        <i class="bi bi-calendar-check fs-1"></i>
                        <h5 class="mt-2">Kehadiran</h5>
                        <p class="mb-0">Kelola data kehadiran siswa</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Nilai --}}
        <div class="col-md-4">
            <a href="{{ route('guru.grade.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 bg-success text-white h-100">
                    <div class="card-body">
                        <i class="bi bi-bar-chart-fill fs-1"></i>
                        <h5 class="mt-2">Nilai</h5>
                        <p class="mb-0">Input & lihat nilai siswa</p>
                    </div>
                </div>
            </a>
        </div>

        {{-- Laporan Siswa --}}
        <div class="col-md-4">
            <a href="{{ route('guru.laporan.index') }}" class="text-decoration-none">
                <div class="card shadow-sm border-0 bg-warning text-dark h-100">
                    <div class="card-body">
                        <i class="bi bi-journal-text fs-1"></i>
                        <h5 class="mt-2">Laporan Siswa</h5>
                        <p class="mb-0">Catatan perilaku siswa</p>
                    </div>
                </div>
            </a>
        </div>

    </div>

</div>
@endsection
