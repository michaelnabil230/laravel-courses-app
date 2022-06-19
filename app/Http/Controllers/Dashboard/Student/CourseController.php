<?php

namespace App\Http\Controllers\Dashboard\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Course $course)
    {
        $students = $course
            ->students()
            ->latest()
            ->paginate()
            ->appends(request()->query());

        return view('dashboard.courses.students.index', compact('course', 'students'));
    }

    public function create(Course $course)
    {
        $students = Student::query()
            ->whereDoesntHave('courses', function ($query) use ($course) {
                $query->where('course_id', $course->id);
            })
            ->pluck('name', 'id');

        return view('dashboard.courses.students.create', compact('course', 'students'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'student_id' => ['required', 'exists:students,id']
        ]);

        $course->students()->attach($request->student_id);

        $this->success('dashboard.added_successfully');

        return to_route('dashboard.courses.students.index', $course->id);
    }

    public function destroy(Course $course, Student $student)
    {
        $course->students()->detach($student->id);

        $this->success('dashboard.deleted_successfully');

        return to_route('dashboard.courses.students.index', $course->id);
    }
}
