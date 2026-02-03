@extends('layouts.app')

@section('content')
<div class="card p-4">

    <div class="d-flex justify-content-between mb-4">
        <h4>Data Guru Mengajar</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTeaching">
            New Assignment
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Guru</th>
                <th>Kelas</th>
                <th>Mata Pelajaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($teaching as $t)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ optional($t->guru)->nama ?? '-' }}</td>
                <td>{{ optional($t->kelas)->name ?? '-' }}</td>
                <td>{{ optional($t->subject)->name ?? '-' }}</td>
                <td>
                    <!-- EDIT -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editTeaching{{ $t->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    
                    <!-- DELETE -->
                    <form action="{{ route('admin.teaching.destroy', $t->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus penugasan ini?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <!-- MODAL EDIT -->
            <div class="modal fade" id="editTeaching{{ $t->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('admin.teaching.update', $t->id) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Penugasan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Guru</label>
                                <select name="guru_id" class="form-select" required>
                                    <option value="">Select an option</option>
                                    @foreach($guru as $g)
                                        <option value="{{ $g->id }}" {{ $t->guru_id == $g->id ? 'selected' : '' }}>
                                            {{ $g->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Kelas</label>
                                <select name="kelas_id" class="form-select" required>
                                    <option value="">Select an option</option>
                                    @foreach($kelas as $k)
                                        <option value="{{ $k->id }}" {{ $t->kelas_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Mata Pelajaran</label>
                                <select name="subject_id" class="form-select" required>
                                    <option value="">Pilih Subject</option>
                                    @foreach($subject as $s)
                                        <option value="{{ $s->id }}" {{ $t->subject_id == $s->id ? 'selected' : '' }}>
                                            {{ $s->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-warning">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>

            @empty
            <tr>
                <td colspan="5" class="text-center text-muted">Belum ada tugas mengajar</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- ========== MODAL ADD TEACHING ASSIGNMENT ========== -->
<div class="modal fade" id="addTeaching" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.teaching.store') }}" class="modal-content">
      @csrf

      <div class="modal-header">
        <h5 class="modal-title">Tambah Teaching Assignment</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="mb-3">
          <label>Guru</label>
          <select name="guru_id" class="form-control" required>
            <option value="">Select an option</option>
            @foreach($guru as $g)
                <option value="{{ $g->id }}">{{ $g->nama }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label>Kelas</label>
          <select name="kelas_id" class="form-control" required>
            <option value="">Select an option</option>
            @foreach($kelas as $k)
                <option value="{{ $k->id }}">{{ $k->name }}</option>
            @endforeach
          </select>
        </div>

        <div class="mb-3">
          <label>Subject</label>
          <select name="subject_id" class="form-select" required>
            <option value="">Select an option</option>
            @foreach($subject as $s)
                <option value="{{ $s->id }}">{{ $s->name }}</option>
            @endforeach
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
@endsection
