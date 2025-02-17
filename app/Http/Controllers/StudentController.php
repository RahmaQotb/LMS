<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $subjectId = 1;  
        $subject = Subject::findOrFail($subjectId);

        $students = $subject->users()->get();

        return view('Dashboard.student.index', compact('students', 'subject'));
    }

    public function updateStatus(Request $request)
    {
        // if (!$request->user()->isAdmin()) {
        //     return redirect()->back()->with('error', 'غير مصرح لك بهذا الإجراء.');
        // }

        $subject = Subject::findOrFail(1);

       
        foreach ($request->status as $studentId => $status) {
            $subject->users()->updateExistingPivot($studentId, [
                'status' => $status,
            ]);
        }

        return redirect()->back()->with('success', 'تم تحديث الحالات بنجاح.');
    }

    public function show(User $student)
    {
        $student->load('subjects'); 
        return view('Dashboard.student.show', compact('student'));
    }

    public function destroy(string $id)
    {
        $student = User::findOrFail($id);
        $student->delete();
        return redirect()->route('students.index')->with('success', 'تم حذف الطالب بنجاح');
    }
}