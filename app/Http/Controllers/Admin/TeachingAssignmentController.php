<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeachingAssignment;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Subject;
use Illuminate\Http\Request;

class TeachingAssignmentController extends Controller
{
    public function index()
    {
        return view('sispeka.teaching', [
            'teaching' => TeachingAssignment::with(['guru','kelas','subject'])->get(),
            'guru' => Guru::all(),
            'kelas' => Kelas::all(),
            'subject' => Subject::all(),
        ]);
    }

    public function store(Request $request)
    {
        TeachingAssignment::create($request->all());
        return back()->with('success','Penugasan mengajar ditambahkan');
    }

    public function update(Request $request, TeachingAssignment $teaching)
    {
        $teaching->update($request->all());
        return back()->with('success','Penugasan mengajar diperbarui');
    }

    public function destroy(TeachingAssignment $teaching)
    {
        $teaching->delete();
        return back()->with('success','Penugasan Mengajar dihapus');
    }
}

