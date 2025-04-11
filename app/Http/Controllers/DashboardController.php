<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Groups;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        $userRole = auth()->user()->school()->pivot->role;

        $cohorts = Cohort::all();
        $teachers = Teacher::all()->count();
        $students = Student::all()->count();
        $groups = Groups::all()->count();
        return view('pages.dashboard.dashboard-' . $userRole, compact('cohorts', 'teachers', 'students', 'groups'));
    }
}
