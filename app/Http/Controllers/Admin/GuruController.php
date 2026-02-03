<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function index()
    {
        return view('sispeka.guru', [
            'guru' => Guru::all()
        ]);
    }

    public function store(Request $request)
    {
        Guru::create($request->all());
        return back()->with('success','Guru ditambahkan');
    }

    public function update(Request $request, Guru $guru)
    {
        $guru->update($request->all());
        return back()->with('success','Guru diperbarui');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return back()->with('success','Guru dihapus');
    }
}
