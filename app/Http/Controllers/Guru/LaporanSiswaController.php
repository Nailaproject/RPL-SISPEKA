<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\LaporanSiswa;
use App\Models\Siswa;
use App\Models\User;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class LaporanSiswaController extends Controller
{
    public function index()
    {
        $laporan = LaporanSiswa::with([
            'siswa',
            'guru'
        ])->latest()->get();

        $siswa = Siswa::all();

         return view('sispeka.LaporanSiswa', [
        'laporan' => $laporan,
        'siswa'   => $siswa,
        ]);
    }

    public function store(Request $request)
{
    $laporan = LaporanSiswa::create([
        'siswa_id'   => $request->siswa_id,
        'guru_id'    => auth()->id(),
        'jenis'      => $request->jenis,
        'tanggal'    => $request->tanggal,
        'keterangan' => $request->keterangan,
    ]);

    $siswa = Siswa::find($request->siswa_id);

    $wali = User::where('nis', $siswa->nis)
                ->where('role', 'wali')
                ->first();

    if ($wali) {
        Notifikasi::create([
            'user_id' => $wali->id,
            'title'   => 'Laporan Baru',
            'message' => 'Ada laporan baru untuk '.$siswa->name,
        ]);
    }

    return back()->with('success','Laporan berhasil ditambahkan');
}
    public function update(Request $request, LaporanSiswa $laporan)
    {
        $request->validate([
            'jenis'      => 'required|in:perilaku,insiden',
            'tanggal'    => 'required|date',
            'keterangan' => 'required',
        ]);

        $laporan->update([
            'jenis'      => $request->jenis,
            'tanggal'    => $request->tanggal,
            'keterangan' => $request->keterangan,
        ]);

        return back()->with('success','Laporan berhasil diperbarui');
    }

    public function destroy(LaporanSiswa $laporan)
    {
        $laporan->delete();

        return back()->with('success','Laporan berhasil dihapus');
    }
}
