<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\User;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Subject $subject)
    {
        $subject = $this->getSubject($subject);
        return view('Dashboard.subject.index', compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     */
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
    public function show(string $id) {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subject $subject)
    {
        $subject = $this->getSubject($subject);
        return view('Dashboard.subject.edit', compact('subject'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subject $subject)
    {
        $subject = $this->getSubject($subject);
        $validated = $request->validate([
            'drive_url' => 'required|string',
            'google_form_url' => 'required',
            'youtube_url' => 'required'
        ]);
        if ($validated) {
            $subject->update($validated);
        }
        return redirect()->back()->with('success', 'تم تحديث الروابط بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function getSubject(Subject $subject)
    {
        return $subject::findOrFail(1)->with("files", "lecures", "exams");
    }
}
