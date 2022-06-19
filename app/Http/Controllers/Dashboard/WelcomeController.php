<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\Trainer;
use App\Models\Course;

class WelcomeController
{
    public function __invoke()
    {
        $adminsCount = Admin::role('admin')->count();
        $usersCount = User::count();
        $studentsCount = Student::count();
        $trainersCount = Trainer::count();
        $coursesCount = Course::count();

        return view('dashboard.welcome', compact('adminsCount', 'usersCount', 'studentsCount', 'trainersCount', 'coursesCount'));
    }
}
