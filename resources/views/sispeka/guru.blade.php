@extends('layouts.app')

@section('content')
<div class="card p-3">
    <div class="d-flex justify-content-between mb-3">
        <h4 class="fw-bold">Data Guru</h4>
        @if(auth()->user()->role === 'admin')
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGuru">
            New Guru
        </button>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>NIP</th>
                <th>Nama</th>
                <th>JK</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @foreach($guru as $g)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $g->nip }}</td>
                <td>{{ $g->nama }}</td>
                <td class="text-center">{{ $g->jk }}</td>
                <td class="text-center">
                    <!-- EDIT -->
                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editGuru{{ $g->id }}">
                        <i class="bi bi-pencil-square"></i>
                    </button>

                    <!-- DELETE -->
                    <form action="{{ route('admin.guru.destroy',$g->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus guru?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>

            <!-- MODAL EDIT -->
            <div class="modal fade" id="editGuru{{ $g->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form action="{{ route('admin.guru.update',$g->id) }}" method="POST" class="modal-content">
                        @csrf
                        @method('PUT')
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Guru</h5>
                            <button class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label>NIP</label>
                                <input type="text" name="nip" value="{{ $g->nip }}" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label>Nama</label>
                                <input name="nama" value="{{ $g->nama }}" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jk" class="form-control">
                                    <option value="L" {{ $g->jk == 'L' ? 'selected' : '' }}>L</option>
                                    <option value="P" {{ $g->jk == 'P' ? 'selected' : '' }}>P</option>
                                </select>
                            </div>
                        <div class="modal-footer">
                            <button class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
        </tbody>
    </table>
</div>

<!-- MODAL ADD -->
@if(auth()->user()->role === 'admin')
<div class="modal fade" id="addGuru" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.guru.store') }}" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">New Guru</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>NIP</label>
                    <input type="text" name="nip" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Nama</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis Kelamin</label>
                    <select name="jk" class="form-control">
                        <option value="L">L</option>
                        <option value="P">P</option>
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
@endsection
