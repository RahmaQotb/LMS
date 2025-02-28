<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\File;
use App\Models\Lecture;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $files = File::all();
        return view('Dashboard.file.index', compact("files"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("Dashboard.file.create");
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                "drive_url" => "required",
                Rule::unique(File::class, "drive_url")
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
    public function destroy(File $file, $id)
    {
        $file::findOrFail($id);
        return redirect()->with("success", "تم حذف الرابظ بنجاح");
    }
}
