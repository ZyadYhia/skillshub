<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $studentRole = Role::where('name', 'student')->first();
        $data['students'] = User::where('role_id', $studentRole->id)
            ->orderBy('id', 'DESC')
            ->paginate(10);
        return view('admin.students.index')->with($data);
    }
    public function showScores($id)
    {
        $data['student'] = User::findOrFail($id);
        if ($data['student']->role->name !== "student") {
            return back();
        }
        $data['exams'] =  $data['student']->exams;
        return view('admin.students.show-score')->with($data);
    }
    // public function toggleExam($studentId, $examId)
    // {
    //     $student = User::findOrFail($studentId);
    //     if ($student->exam->status == "closed") {
    //         $status = "opened";
    //     } else if ($student->exam->status == "opened"){
    //         $status = "closed";
    //     }
    //     $student->exams()->updateExistingPivot($examId,[
    //         'status' => $status,
    //     ]);
    //     return back();
    // }
    public function openExam($studentId, $examId)
    {
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId,[
            'status' => 'opened',
        ]);
        return back();
    }
    public function closeExam($studentId, $examId)
    {
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId,[
            'status' => 'closed',
        ]);
        return back();
    }
}
