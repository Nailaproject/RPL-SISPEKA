@extends('layouts.app')

@section('content')
<div class="card p-3">

    <div class="d-flex justify-content-between mb-4">
        <h4>Data Mata Pelajaran</h4>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubject">
            New Subject
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Nama Mata Pelajaran</th>
                <th>Kode</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach($subject as $s)
            <tr class="text-center">
                <td>{{ $loop->iteration }}</td>
                <td class="text-start">{{ $s->name }}</td>
                <td>{{ $s->code }}</td>
                <td>
                    <!-- EDIT -->
                    <button class="btn btn-sm btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#editSubject{{ $s->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- DELETE -->
                    <form action="{{ route('admin.subject.destroy', $s->id) }}"
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

{{-- ================= MODAL EDIT ================= --}}
@foreach($subject as $s)
<div class="modal fade" id="editSubject{{ $s->id }}" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST"
          action="{{ route('admin.subject.update', $s->id) }}"
          class="modal-content">
      @csrf
      @method('PUT')

      <div class="modal-header">
        <h5 class="modal-title">Edit Mata Pelajaran</h5>
        <button class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Mata Pelajaran</label>
          <input type="text" name="name" value="{{ $s->name }}" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Kode</label>
          <input type="text" name="code" value="{{ $s->code }}" class="form-control" required>
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

{{-- ================= MODAL ADD ================= --}}
<div class="modal fade" id="addSubject" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.subject.store') }}" class="modal-content">
      @csrf

      <div class="modal-header">
        <h5 class="modal-title">Tambah Mata Pelajaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="mb-3">
          <label>Nama Mata Pelajaran</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Kode</label>
          <input type="text" name="code" class="form-control" required>
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
