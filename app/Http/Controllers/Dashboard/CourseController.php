<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CourseRequest;
use App\Models\Course;
use App\Models\Location;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read-courses'])->only(['index', 'show']);
        $this->middleware(['permission:create-courses'])->only(['create', 'store']);
        $this->middleware(['permission:update-courses'])->only(['edit', 'update']);
        $this->middleware(['permission:delete-courses'])->only('destroy');
    }

    public function index(Request $request)
    {
        $courses = Course::query()
            ->when($request->search, function ($query, $search) {
                return $query
                    ->orWhere(DB::raw("name->'$.column' LIKE %$search%"))
                    ->orWhere(DB::raw("title->'$.column' LIKE %$search%"));
            })
            ->withCount('students')
            ->with(['trainer:id,name', 'location'])
            ->latest()
            ->paginate()
            ->appends($request->query());

        return view('dashboard.courses.index', compact('courses'));
    }

    public function create()
    {
        $trainers = Trainer::pluck('id', 'name');
        $locations = Location::get();

        return view('dashboard.courses.create', compact('trainers', 'locations'));
    }

    public function store(CourseRequest $request)
    {
        Course::create($request->validated());

        $this->success('dashboard.added_successfully');

        return back();
    }

    public function edit(Course $course)
    {
        $trainers = Trainer::pluck('id', 'name');
        $locations = Location::get();

        return view('dashboard.courses.edit', compact('course', 'trainers', 'locations'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        $this->success('dashboard.updated_successfully');

        return to_route('dashboard.courses.index');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        $this->success('dashboard.deleted_successfully');

        return to_route('dashboard.courses.index');
    }
}
