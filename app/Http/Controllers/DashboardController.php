<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Subject;
use App\Models\TeachingAssignment;
use App\Models\LaporanSiswa;
use App\Models\Notifikasi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function admin()
    {
        return view('dashboard.admin', [
            'guruCount'    => Guru::count(),
            'siswaCount'   => Siswa::count(),
            'kelasCount'   => Kelas::count(),
            'subjectCount' => Subject::count(),
            'assignmentCount'=> TeachingAssignment::count(),
        ]);
    }

    public function guru()
    {
        return view('dashboard.guru', [
            'siswaCount'   => Siswa::count(),
            'kelasCount'   => Kelas::count(),
            'laporanCount' => LaporanSiswa::count(),
        ]);
    }

     public function wali()
    {
    
        $user = auth()->user();

        $siswa = Siswa::where('nis', $user->nis)->get();

        $laporan = LaporanSiswa::whereHas('siswa', function ($q) use ($user) {
            $q->where('nis', $user->nis);
        })->get();

        $notifikasi = Notifikasi::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard.wali', [
            'totalAnak'       => $siswa->count(),
            'totalLaporan'    => $laporan->count(),
            'totalNotifikasi' => $notifikasi->where('is_read', false)->count(),
            'notifikasi'      => $notifikasi,
        ]);
    }
}