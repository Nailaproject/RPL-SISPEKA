<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return view('sispeka.subject', [
            'subject' => Subject::all()
        ]);
    }

    public function store(Request $request)
    {
        Subject::create($request->all());
        return back()->with('success','Mapel ditambahkan');
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->all());
        return back()->with('success','Mapel diperbarui');
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return back()->with('success','Mapel dihapus');
    }
}
