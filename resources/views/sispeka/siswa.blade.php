@extends('layouts.app')

@section('content')
<div class="card p-4">

<div class="d-flex justify-content-between mb-4">
    <h2>Data Siswa</h2>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSiswa">
            New Siswa
        </button>
</div>

@if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
<table class="table table-bordered table-striped">
 <thead class="table-primary text-center">
<tr>
    <th class="text-center">No</th>
    <th class="text-center">Nama</th>
    <th class="text-center">NISN</th>
    <th class="text-center">Kelas</th>
    <th class="text-center">Aksi</th>
</tr>
</thead>

<tbody>
@foreach ($siswa as $s)
<tr>
    <td class="text-center">{{ $loop->iteration }}</td>
    <td>{{ $s->name }}</td>
    <td>{{ $s->nis }}</td>
    <td>{{ optional($s->kelas)->name ?? '-' }}</td>
    <td class="text-center">

     <!-- EDIT -->
      <button class="btn btn-warning btn-sm"
      data-bs-toggle="modal"
      data-bs-target="#editSiswa{{ $s->id }}">
        <i class="bi bi-pencil-square"></i>
    </button>

      <!-- HAPUS -->
      <form action="{{ route('admin.siswa.destroy', $s->id) }}"
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

        <!-- MODAL EDIT -->
        <div class="modal fade" id="editSiswa{{ $s->id }}" tabindex="-1">
        <div class="modal-dialog">
          <form action="{{ route('admin.siswa.update',$s->id) }}" method="POST"
          class="modal-content">
          @csrf
          @method('PUT')

      <div class="modal-content">
      <div class="modal-header">
      <h5 class="modal-title">Edit Siswa</h5>
      <button class="btn-close" data-bs-dismiss="modal"></button>
    </div>

      <div class="modal-body">
      <div class="mb-3">
      <label>Nama Siswa</label>
      <input type="text" name="name"
        value="{{ $s->name }}"
        class="form-control mb-2">
    </div>
                        
      <div class="mb-3">
      <label>NISN</label>
      <input type="text" name="nis"
        class="form-control mb-2"
        value="{{ $s->nis }}"
        class="form-control" required>

      <div class="mb-3">
      <label>Kelas</label>
      <select name="kelas_id" class="form-select text-dark" required>
      <option value="">Select an option</option>
     @foreach($kelas as $k)
        <option value="{{ $k->id }}"
            {{ $s->kelas_id == $k->id ? 'selected' : '' }}>
            {{ $k->name }}
          </option>
        @endforeach
  </select>
  </div>
  
    <div class="modal-footer">
    <button class="btn btn-warning">Update</button>
    <button type="button" class="btn btn-secondary"
    data-bs-dismiss="modal">
      Batal
    </button>
    </div>
  </form>
  </div>
  </div>
  @endforeach
  </tbody>
</table>
</div>

<!-- MODAL TAMBAH -->
<div class="modal fade" id="addSiswa" tabindex="-1">
  <div class="modal-dialog">
    <form method="POST" action="{{ route('admin.siswa.store') }}" class="modal-content">
      @csrf

      <div class="modal-header">
        <h5 class="modal-title">Tambah Siswa</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">

        <div class="mb-3">
          <label>Nama Siswa</label>
          <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>NISN</label>
          <input type="text" name="nis" class="form-control" required>
        </div>

        <div class="mb-3">
          <label>Kelas</label>
          <select name="kelas_id" class="form-select" required>
            <option value="">Select an option</option>
            @foreach($kelas as $k)
              <option value="{{ $k->id }}">{{ $k->name }}</option>
            @endforeach
          </select>
        </div>

      <div class="modal-footer">
        <button class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
      </div>

    </form>
  </div>
</div>
@endsection