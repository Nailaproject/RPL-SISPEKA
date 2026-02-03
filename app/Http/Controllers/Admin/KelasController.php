<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        return view('sispeka.kelas', [
            'kelas' => Kelas::with('waliKelas')->get(),
            'guru'  => Guru::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'grade' => 'required',
            'wali_kelas_id' => 'nullable|exists:guru,id',
        ]);

        Kelas::create($request->all());
        return back()->with('success','Kelas berhasil ditambahkan');
    }

   public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $kelas->update($request->all());

        return back()->with('success','Kelas berhasil diupdate');
    }

    public function destroy($id)
    {
        Kelas::destroy($id);
        return back()->with('success','Kelas berhasil dihapus');
    }
}