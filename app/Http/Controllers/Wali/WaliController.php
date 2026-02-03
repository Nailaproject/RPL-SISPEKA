<?php

namespace App\Http\Controllers\Wali;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\LaporanSiswa;
use App\Models\Siswa;
use Illuminate\Support\Facades\Auth;

class WaliController extends Controller
{
  public function attendance()
{
    $nis = Auth::user()->nis;

    $siswa = Siswa::where('nis', $nis)->first();
    $attendances = $siswa ? $siswa->attendances : collect();

    return view('sispeka.kehadiran', compact('attendances'));
}

    public function grade()
    {
        $nis = Auth::user()->nis;

        $siswa = Siswa::where('nis', $nis)->first();
        $nilai = $siswa ? $siswa->grades : collect();

        return view('sispeka.nilai', compact('nilai'));
    }

   public function laporan()
{
    $user = auth()->user();

    $laporan = LaporanSiswa::whereHas('siswa', function ($q) use ($user) {
        $q->where('nis', $user->nis);
    })->with(['siswa','guru'])->get();

    return view('sispeka.LaporanSiswa', [
        'laporan' => $laporan,
        'siswa'   => collect(), 
    ]);
}

public function wali()
{
    $user = auth()->user();

    // siswa berdasarkan NIS wali
    $siswa = Siswa::where('nis', $user->nis)->get();

    // laporan siswa
    $laporan = LaporanSiswa::whereHas('siswa', function ($q) use ($user) {
        $q->where('nis', $user->nis);
    })->get();

    // notifikasi wali
    $notifikasi = Notifikasi::where('user_id', $user->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('dashboard.wali', [
        'totalAnak'       => $siswa->count(),
        'totalLaporan'    => $laporan->count(),
        'totalNotifikasi' => $notifikasi->where('is_read', false)->count(),
        'notifikasi'      => $notifikasi ?? collect(), // ⬅️ ANTI ERROR
    ]);
}

}
