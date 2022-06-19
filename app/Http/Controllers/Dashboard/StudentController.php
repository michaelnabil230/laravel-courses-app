<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-students'])->only(['index', 'show']);
        $this->middleware(['permission:create-students'])->only(['create', 'store']);
        $this->middleware(['permission:update-students'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-students'])->only('destroy');
    }

    public function index(Request $request)
    {
        $students = Student::query()
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'Like', "%$search%");
            })
            ->latest()
            ->paginate()
            ->appends($request->query());

        return view('dashboard.students.index', compact('students'));
    }

    public function show(Student $student)
    {
        $courses = $student->courses()
            ->with(['trainer:id,name', 'location'])
            ->paginate()
            ->appends(request()->query());

        return view('dashboard.students.show', compact('student', 'courses'));
    }

    public function create()
    {
        return view('dashboard.students.create');
    }

    public function store(StudentRequest $request)
    {
        Student::create($request->validated());

        $this->success('dashboard.added_successfully');

        return back();
    }

    public function edit(Student $student)
    {
        return view('dashboard.students.edit', compact('student'));
    }

    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->validated());

        $this->success('dashboard.updated_successfully');

        return to_route('dashboard.students.index');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        $this->success('dashboard.deleted_successfully');

        return to_route('dashboard.students.index');
    }
}
