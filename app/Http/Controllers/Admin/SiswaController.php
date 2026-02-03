<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        return view('sispeka.siswa', [
            'siswa' => Siswa::with('kelas')->get(),
            'kelas' => Kelas::all()
        ]);
    }

    public function store(Request $request)
    {
        Siswa::create($request->all());
        return back()->with('success','Siswa ditambahkan');
    }

    public function update(Request $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        return back()->with('success','Siswa diperbarui');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        return back()->with('success','Siswa dihapus');
    }
}
