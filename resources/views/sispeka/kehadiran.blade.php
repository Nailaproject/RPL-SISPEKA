@extends('layouts.app')

@section('content')
<div class="card p-4 shadow-sm">

    <div class="d-flex justify-content-between mb-3">
    <h4>Kehadiran</h4>

    @if(auth()->user()->role === 'guru')
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKehadiran">
            New Kehadiran
        </button>
    @endif
</div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Tugas Mengajar</th>
                <th>Tanggal</th>
                <th>Status</th>
                @if(auth()->user()->role === 'guru')
                <th>Aksi</th>
            @endif
            </tr>
        </thead>
        <tbody>
        @forelse($attendances as $a)
        <tr>
    <td class="text-center">{{ $loop->iteration }}</td>
    <td>{{ $a->siswa->name }}</td>
    <td>
        {{ $a->assignment->guru->nama }} -
        {{ $a->assignment->kelas->name }} -
        {{ $a->assignment->subject->name }}
    </td>
    <td class="text-center">{{ $a->date }}</td>
    <td class="text-center">
        <span class="badge bg-success">{{ ucfirst($a->status) }}</span>
    </td>

    @if(auth()->user()->role === 'guru')
    <td class="text-center">
        <div class="d-flex justify-content-center gap-2">

            <!-- EDIT -->
            <button class="btn btn-warning btn-sm"
                data-bs-toggle="modal"
                data-bs-target="#editKehadiran{{ $a->id }}">
                <i class="bi bi-pencil-square"></i>
            </button>

            <!-- DELETE -->
            <form action="{{ route('guru.attendance.destroy',$a->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button onclick="return confirm('Hapus?')" class="btn btn-danger btn-sm">
                    <i class="bi bi-trash"></i>
                </button>
                    </form>
                </div>
                </td>
                @endif
            </tr>
            @empty

            <tr>
                <td colspan="6" class="text-center text-muted">Belum ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- MODAL ADD -->
 @if(auth()->user()->role === 'guru')
<div class="modal fade" id="addKehadiran" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('guru.attendance.store') }}" class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Kehadiran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-select" required>
                        <option value="">Select an option</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tugas Mengajar</label>
                    <select name="assignment_id" class="form-select" required>
                        <option value="">Select an option</option>
                        @foreach($assignment as $t)
                            <option value="{{ $t->id }}">
                                {{ $t->guru->nama }} - {{ $t->kelas->name }} - {{ $t->subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="">Select an option</option>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alpha">Alpha</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>

        </form>
    </div>
</div>
@endif
<!-- MODAL EDIT -->
@if(auth()->user()->role === 'guru')
@foreach($attendances as $a)
<div class="modal fade" id="editKehadiran{{ $a->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST" action="{{ route('guru.attendance.update', $a->id) }}" class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Kehadiran</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-select" required>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}" {{ $s->id == $a->siswa_id ? 'selected' : '' }}>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tugas Mengajar</label>
                    <select name="assignment_id" class="form-select" required>
                        @foreach($assignment as $t)
                            <option value="{{ $t->id }}" {{ $t->id == $a->assignment_id ? 'selected' : '' }}>
                                {{ $t->guru->nama }} - {{ $t->kelas->name }} - {{ $t->subject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tanggal</label>
                    <input type="date" name="date" class="form-control" value="{{ $a->date }}" required>
                </div>

                <div class="mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select" required>
                        <option value="hadir" {{ $a->status == 'hadir' ? 'selected' : '' }}>Hadir</option>
                        <option value="izin" {{ $a->status == 'izin' ? 'selected' : '' }}>Izin</option>
                        <option value="sakit" {{ $a->status == 'sakit' ? 'selected' : '' }}>Sakit</option>
                        <option value="alpha" {{ $a->status == 'alpha' ? 'selected' : '' }}>Alpha</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>

        </form>
    </div>
</div>
@endforeach
@endif
@endsection
