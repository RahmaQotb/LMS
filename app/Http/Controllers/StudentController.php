<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // $subjectId = 1;  
        $subject = Subject::findOrFail(1);
        $students = User::all();
        // $students = $subject->users()->get();

        return view('Dashboard.student.index', compact('students', 'subject'));

        // dd('reached');
    }

    public function studentReq()
        {
            // dd('ddd');
            $subject = Subject::findOrFail(1); 
            $students = $subject->users()->withPivot('status')->get(); 
            return view('Dashboard.student.requested', compact('students', 'subject'));
        }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
  

    public function updateStatus(Request $request)
    {

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