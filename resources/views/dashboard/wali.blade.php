@extends('layouts.app')

@section('content')
<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold text-primary">Dashboard Wali</h3>
        <p class="text-muted">
            Selamat datang, <strong>{{ auth()->user()->name }}</strong>
        </p>
    </div>

    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-success text-white">
                <div class="card-body">
                    <i class="bi bi-people fs-1"></i>
                    <h6 class="mt-2">Total Anak</h6>
                    <h3>{{ $totalAnak }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-warning text-dark">
                <div class="card-body">
                    <i class="bi bi-file-text fs-1"></i>
                    <h6 class="mt-2">Total Laporan</h6>
                    <h3>{{ $totalLaporan }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-danger text-white">
                <div class="card-body">
                    <i class="bi bi-bell fs-1"></i>
                    <h6 class="mt-2">Notifikasi Baru</h6>
                    <h3>{{ $totalNotifikasi }}</h3>
                </div>
            </div>
        </div>

    </div>

    {{-- NOTIFIKASI --}}
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <strong>Notifikasi</strong>
        </div>

        <ul class="list-group list-group-flush">
            @forelse($notifikasi as $n)
                <li class="list-group-item d-flex justify-content-between align-items-center
                    {{ $n->is_read ? '' : 'fw-bold' }}">
                    
                    <div>
                        <div>{{ $n->title }}</div>
                        <small class="text-muted">{{ $n->message }}</small>
                    </div>

                    @if(!$n->is_read)
                        <span class="badge bg-danger">Baru</span>
                    @endif
                </li>
            @empty
                <li class="list-group-item text-center text-muted">
                    Tidak ada notifikasi
                </li>
            @endforelse
        </ul>
    </div>

</div>
@endsection
