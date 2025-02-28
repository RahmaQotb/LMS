<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class LectureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lectures = Lecture::all();
        return view('Dashboard.lecture.index', compact("lectures"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view("Dashboard.lecture.create");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "youtube_url" => "required",
                Rule::unique(Lecture::class, "youtube_url")
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
    public function destroy(Lecture $lecture, $id)
    {
        $lecture::findOrFail($id);
        return redirect()->with("success", "تم حذف الرابظ بنجاح");
    }
}
