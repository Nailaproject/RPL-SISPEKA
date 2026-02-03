<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Siswa;
use App\Models\TeachingAssignment;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        $attendances = Attendance::with([
            'siswa',
            'assignment.guru',
            'assignment.kelas',
            'assignment.subject'
        ])->get();

        $siswa = Siswa::all();
        $assignment = TeachingAssignment::with(['guru','kelas','subject'])->get();

        return view('sispeka.kehadiran', compact(
            'attendances',
            'siswa',
            'assignment'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'siswa_id'      => 'required|exists:siswa,id',
            'assignment_id' => 'required|exists:teaching_assignments,id',
            'date'          => 'required|date',
            'status'        => 'required',
        ]);

        Attendance::create([
            'siswa_id'      => $request->siswa_id,
            'assignment_id' => $request->assignment_id,
            'date'          => $request->date,
            'status'        => $request->status,
            'recorded_by'   => auth()->id(), 
        ]);

        return redirect()
            ->route('guru.attendance.index')
            ->with('success','Absensi disimpan');
    }

    public function update(Request $request, Attendance $attendance)
    {
        $request->validate([
            'siswa_id'      => 'required|exists:siswa,id',
            'assignment_id' => 'required|exists:teaching_assignments,id',
            'date'          => 'required|date',
            'status'        => 'required',
        ]);

        $attendance->siswa_id = $request->siswa_id;
        $attendance->assignment_id = $request->assignment_id;
        $attendance->date = $request->date;
        $attendance->status = $request->status;
        $attendance->save();

        return back()->with('success','Absensi diperbarui');
    }

    public function destroy(Attendance $attendance)
    {
        $attendance->delete();

        return back()->with('success','Absensi dihapus');
    }
}
