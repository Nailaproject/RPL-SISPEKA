@extends('layouts.app')
@section('title','Laporan Siswa')

@section('content')
<div class="card p-3">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold">Laporan Siswa</h4>

        @if(auth()->user()->role !== 'wali')
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahLaporan">
                New Laporan
            </button>
        @endif
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-sm bg-white">
        <thead class="table-primary text-center">
            <tr>
                <th>No</th>
                <th>Siswa</th>
                <th>Guru</th>
                <th>Jenis</th>
                <th>Tanggal</th>
                <th>Keterangan</th>
                @if(auth()->user()->role !== 'wali')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @forelse($laporan as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ $item->siswa->name }}</td>
                    <td>{{ optional($item->guru)->nama ?? '-' }}</td>
                    <td class="text-center">
                        @php
                            $badgeClass = $item->jenis === 'perilaku'
                                ? 'bg-success'
                                : 'bg-danger';
                        @endphp
                        <span class="badge {{ $badgeClass }}">
                            {{ ucfirst($item->jenis) }}
                        </span>
                    </td>
                    <td class="text-center">{{ $item->tanggal }}</td>
                    <td>{{ $item->keterangan }}</td>

                    @if(auth()->user()->role !== 'wali')
                        <td class="text-center">
                            <button
                                class="btn btn-warning btn-sm"
                                data-bs-toggle="modal"
                                data-bs-target="#editModal{{ $item->id }}"
                            >
                                <i class="bi bi-pencil-square"></i>
                            </button>

                            <form
                                action="{{ route('guru.laporan.destroy',$item->id) }}"
                                method="POST"
                                class="d-inline"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin hapus laporan?')"
                                >
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center text-muted">
                        Belum ada laporan
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- ================= MODAL EDIT ================= --}}
    @if(auth()->user()->role !== 'wali')
        @foreach($laporan as $item)
            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1">
                <div class="modal-dialog">
                    <form
                        method="POST"
                        action="{{ route('guru.laporan.update',$item->id) }}"
                        class="modal-content"
                    >
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5>Edit Laporan</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="mb-3">
                                <label>Jenis</label>
                                <select name="jenis" class="form-select" required>
                                    <option value="perilaku" {{ $item->jenis=='perilaku'?'selected':'' }}>
                                        Perilaku
                                    </option>
                                    <option value="insiden" {{ $item->jenis=='insiden'?'selected':'' }}>
                                        Insiden
                                    </option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Tanggal</label>
                                <input
                                    type="date"
                                    name="tanggal"
                                    class="form-control"
                                    value="{{ $item->tanggal }}"
                                    required
                                >
                            </div>

                            <div class="mb-3">
                                <label>Keterangan</label>
                                <textarea
                                    name="keterangan"
                                    class="form-control"
                                    required
                                >{{ $item->keterangan }}</textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-warning">Update</button>
                            <button
                                type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal"
                            >
                                Batal
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        @endforeach
    @endif

    {{-- ================= MODAL TAMBAH ================= --}}
    @if(auth()->user()->role !== 'wali')
        <div class="modal fade" id="tambahLaporan" tabindex="-1">
            <div class="modal-dialog">
                <form
                    method="POST"
                    action="{{ route('guru.laporan.store') }}"
                    class="modal-content"
                >
                    @csrf

                    <div class="modal-header">
                        <h5>Tambah Laporan</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Siswa</label>
                            <select name="siswa_id" class="form-select" required>
                                <option value="">Pilih Siswa</option>
                                @foreach($siswa as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Jenis</label>
                            <select name="jenis" class="form-select" required>
                                <option value="">Pilih Jenis</option>
                                <option value="perilaku">Perilaku</option>
                                <option value="insiden">Insiden</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Simpan</button>
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                        >
                            Batal
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif

</div>
@endsection
