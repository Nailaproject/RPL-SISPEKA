@extends('layouts.app')

@section('content')
<div class="card p-3">

    <div class="d-flex justify-content-between mb-4">
        <h4>Data Kelas</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addKelas">
            New Kelas
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Nama Kelas</th>
                <th>Grade</th>
                <th>Wali Kelas</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($kelas as $k)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td>{{ $k->name }}</td>
                <td>{{ $k->grade }}</td>
                <td>
                    {{ $k->wali_kelas_id
                        ? optional($guru->firstWhere('id',$k->wali_kelas_id))->nama
                        : '-' }}
                </td>
                <td>
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editKelas{{ $k->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <form action="{{ route('admin.kelas.destroy',$k->id) }}"
                          method="POST"
                          style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger"
                            onclick="return confirm('Yakin hapus?')">
                             <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

{{-- ================= MODAL EDIT (DI LUAR TABLE) ================= --}}
@foreach($kelas as $k)
<div class="modal fade" id="editKelas{{ $k->id }}" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST"
          action="{{ route('admin.kelas.update',$k->id) }}"
          class="modal-content">
      @csrf
      @method('PUT')

      <div class="modal-header">
        <h5 class="modal-title">Edit Kelas</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Kelas</label>
          <input type="text"
                 name="name"
                 value="{{ $k->name }}"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <label>Grade</label>
          <input type="number"
                 name="grade"
                 value="{{ $k->grade }}"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <label>Wali Kelas</label>
          <select name="wali_kelas_id" class="form-select">
            <option value="">Select an option</option>
            @foreach($guru as $g)
              <option value="{{ $g->id }}"
                {{ $k->wali_kelas_id == $g->id ? 'selected' : '' }}>
                {{ $g->nama }}
              </option>
            @endforeach
          </select>
        </div>
      </div>

      <div class="modal-footer">
        <button class="btn btn-primary">Simpan</button>
        <button type="button"
                class="btn btn-secondary"
                data-bs-dismiss="modal">
            Batal
        </button>
      </div>

    </form>
  </div>
</div>
@endforeach

{{-- ================= MODAL ADD ================= --}}
<div class="modal fade" id="addKelas" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST"  action="{{ route('admin.kelas.store') }}" class="modal-content">
      @csrf

      <div class="modal-header">
        <h5 class="modal-title">Tambah Kelas</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="mb-3">
          <label>Nama Kelas</label>
          <input type="text"
                 name="name"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <label>Grade</label>
          <input type="number"
                 name="grade"
                 class="form-control"
                 required>
        </div>

        <div class="mb-3">
          <label>Wali Kelas</label>
          <select name="wali_kelas_id" class="form-select">
            <option value="">Select an option</option>
            @foreach($guru as $g)
              <option value="{{ $g->id }}">{{ $g->nama }}</option>
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
