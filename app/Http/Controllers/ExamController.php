<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $exams = Exam::all();
        return view('Dashboard.exam.index', compact("exams"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("Dashboard.exam.create");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "google_form_url" => "required",
                Rule::unique(Exam::class, "google_form_url")
            ],
            [
                "required" => "The :attribute is required",
                "unique" => "The :attribute is already exists"
            ]
        );
        return $validated ?? redirect()->with("success", "تم إضافة الرابط بنجاح");
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

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
    public function destroy(Exam $exam, $id)
    {
        $exam::findOrFail($id);
        return redirect()->with("success", "تم حذف الرابظ بنجاح");
    }
}
