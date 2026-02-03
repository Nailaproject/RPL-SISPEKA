@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold text-primary">Dashboard Admin</h3>
        <p class="text-muted mb-0">
            Selamat datang, <strong>{{ auth()->user()->name }}</strong>
        </p>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-4">

        {{-- Guru --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-primary text-white">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-person-workspace fs-1 me-3"></i>
                    <div>
                        <small>Guru</small>
                        <h3 class="fw-bold mb-0">{{ $guruCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Siswa --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-people-fill fs-1 me-3"></i>
                    <div>
                        <small>Siswa</small>
                        <h3 class="fw-bold mb-0">{{ $siswaCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kelas --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-door-open fs-1 me-3"></i>
                    <div>
                        <small>Kelas</small>
                        <h3 class="fw-bold mb-0">{{ $kelasCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Mata Pelajaran --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-info text-white">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-book fs-1 me-3"></i>
                    <div>
                        <small>Mata Pelajaran</small>
                        <h3 class="fw-bold mb-0">{{ $subjectCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

        {{-- Penugasan Mengajar --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-danger text-white">
                <div class="card-body d-flex align-items-center">
                    <i class="bi bi-journal-check fs-1 me-3"></i>
                    <div>
                        <small>Penugasan Mengajar</small>
                        <h3 class="fw-bold mb-0">{{ $assignmentCount }}</h3>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
