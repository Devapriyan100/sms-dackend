<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Course::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedDate = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'required|exists:teachers,id',
        ]);
        return Course::create($validatedDate);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Course::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findorfail($id);
        $validatedData = $request->validate([
            'title' => 'string|max:255',
            'description' => 'nullable|string',
            'teacher_id' => 'exists:teachers,id'
        ]);
        $course->update($validatedData);
        return $course;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $course = Course::findOrFail($id);
        $course->delete();
        return response()->json(['message' => 'Course Deleted']);
    }
}
