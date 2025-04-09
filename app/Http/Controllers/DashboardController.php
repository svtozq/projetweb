<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cohort;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Groups;

class DashboardController extends Controller
{
    public function index() {
        $userRole = auth()->user()->school()->pivot->role;

        $cohorts = Cohort::all()->count();
        $teachers = Teacher::all()->count();
        $students = Student::all()->count();
        $groups = Groups::all()->count();
        return view('pages.dashboard.dashboard-' . $userRole, compact('cohorts', 'teachers', 'students', 'groups'));
    }
}
