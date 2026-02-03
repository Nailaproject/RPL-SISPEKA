<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\Siswa;
use App\Models\TeachingAssignment;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $nilai = Grade::with([
            'siswa',
            'assignment.guru',
            'assignment.kelas',
            'assignment.subject'
        ])->get();

        $siswa = Siswa::all();
        $assignment = TeachingAssignment::with(['guru','kelas','subject'])->get();

        return view('sispeka.nilai', compact('nilai','siswa','assignment'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'assignment_id' => 'required|exists:teaching_assignments,id',
            'type' => 'required|in:tugas,uts,uas',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        Grade::create($request->only(['siswa_id','assignment_id','type','score']));

        return redirect()->route('guru.grade.index')
            ->with('success','Nilai berhasil ditambahkan.');
    }

    public function update(Request $request, Grade $grade)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswa,id',
            'assignment_id' => 'required|exists:teaching_assignments,id',
            'type' => 'required|in:tugas,uts,uas',
            'score' => 'required|numeric|min:0|max:100',
        ]);

        $grade->siswa_id = $request->siswa_id;
        $grade->assignment_id = $request->assignment_id;
        $grade->type = $request->type;
        $grade->score = $request->score;
        $grade->save();

        return back()->with('success','Nilai berhasil diperbarui.');
    }


    public function destroy(Grade $grade)
    {
        $grade->delete();

        return back()->with('success','Nilai berhasil dihapus.');
    }
}
