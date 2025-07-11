<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Student;

class EnrollmentController extends Controller
{
    public function enroll(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        $student->courses()->attach($request->course_id, ['enrolled_at' => now()]);

        return response()->json(['message' => 'Student enrolled successfully']);
    }

    public function unenroll(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
        ]);

        $student = Student::findOrFail($request->student_id);
        $student->courses()->detach($request->course_id);

        return response()->json(['message' => 'Student unenrolled successfully']);
    }
}
