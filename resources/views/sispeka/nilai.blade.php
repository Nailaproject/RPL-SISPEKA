@extends('layouts.app')

@section('content')
<div class="card shadow-sm p-3">

    <div class="d-flex justify-content-between mb-4">
        <h4>Data Nilai</h4>

        @if(auth()->user()->role === 'guru')
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNilai">
                New Nilai
            </button>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Siswa</th>
                    <th>Tugas Mengajar</th>
                    <th>Jenis</th>
                    <th>Nilai</th>
                    @if(auth()->user()->role === 'guru')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>

            <tbody>
            @forelse($nilai as $n)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>

                    <td>{{ $n->siswa->name ?? '-' }}</td>

                    <td>
                        {{ optional(optional($n->assignment)->guru)->nama ?? '-' }} -
                        {{ optional(optional($n->assignment)->kelas)->name ?? '-' }} -
                        {{ optional(optional($n->assignment)->subject)->name ?? '-' }}
                    </td>

                    <td class="text-center">
                        <span class="badge bg-info">{{ strtoupper($n->type) }}</span>
                    </td>

                    <td class="text-center">
                        <strong>{{ $n->score }}</strong>
                    </td>

                    @if(auth()->user()->role === 'guru')
                    <td class="text-center">
                        <button class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editNilai{{ $n->id }}">
                            <i class="bi bi-pencil-square"></i>
                        </button>

                        <form action="{{ route('guru.grade.destroy', $n->id) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus nilai?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada data nilai
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ================= MODAL EDIT (GURU ONLY) ================= --}}
@if(auth()->user()->role === 'guru')
@foreach($nilai as $n)
<div class="modal fade" id="editNilai{{ $n->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST"
              action="{{ route('guru.grade.update', $n->id) }}"
              class="modal-content">
            @csrf
            @method('PUT')

            <div class="modal-header">
                <h5 class="modal-title">Edit Nilai</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-control" required>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}"
                                {{ $n->siswa_id == $s->id ? 'selected' : '' }}>
                                {{ $s->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tugas Mengajar</label>
                    <select name="assignment_id" class="form-control" required>
                        @foreach($assignment as $a)
                            <option value="{{ $a->id }}"
                                {{ $n->assignment_id == $a->id ? 'selected' : '' }}>
                                {{ optional($a->guru)->nama ?? '-' }} -
                                {{ optional($a->kelas)->name ?? '-' }} -
                                {{ optional($a->subject)->name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jenis Nilai</label>
                    <select name="type" class="form-control" required>
                        <option value="tugas" {{ $n->type == 'tugas' ? 'selected' : '' }}>Tugas</option>
                        <option value="uts" {{ $n->type == 'uts' ? 'selected' : '' }}>UTS</option>
                        <option value="uas" {{ $n->type == 'uas' ? 'selected' : '' }}>UAS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nilai</label>
                    <input type="number" name="score"
                           value="{{ $n->score }}"
                           class="form-control"
                           min="0" max="100" required>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Update</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
@endforeach
@endif

{{-- ================= MODAL TAMBAH (GURU ONLY) ================= --}}
@if(auth()->user()->role === 'guru')
<div class="modal fade" id="addNilai" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <form method="POST"
              action="{{ route('guru.grade.store') }}"
              class="modal-content">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title">Tambah Nilai</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <label>Siswa</label>
                    <select name="siswa_id" class="form-control" required>
                        <option value="">Pilih Siswa</option>
                        @foreach($siswa as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Tugas Mengajar</label>
                    <select name="assignment_id" class="form-control" required>
                        <option value="">Pilih Tugas</option>
                        @foreach($assignment as $a)
                            <option value="{{ $a->id }}">
                                {{ optional($a->guru)->nama ?? '-' }} -
                                {{ optional($a->kelas)->name ?? '-' }} -
                                {{ optional($a->subject)->name ?? '-' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label>Jenis Nilai</label>
                    <select name="type" class="form-control" required>
                        <option value="tugas">Tugas</option>
                        <option value="uts">UTS</option>
                        <option value="uas">UAS</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Nilai</label>
                    <input type="number"
                           name="score"
                           class="form-control"
                           min="0" max="100" required>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Simpan</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            </div>
        </form>
    </div>
</div>
@endif
@endsection
