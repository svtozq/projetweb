<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\CohortsSchools;
use App\Models\Groups;
use App\Models\UserSchool;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
        // Get the logged-in user role
        $userRole = auth()->user()->school()->pivot->role;

        // Get the logged-in user
        $user = auth()->user();

        // Get cohorts of the logged-in user
        $userCohortsId = CohortsSchools::where('user_id', $user->id)->pluck('cohort_id');
        $userCohorts = Cohort::whereIn('id', $userCohortsId)->get();

        // Get objects & counted objects
        $cohort = Cohort::all();
        $cohorts = Cohort::all()->count();
        $teachers = UserSchool::where('role', 'teacher')->count();
        $students = UserSchool::where('role', 'student')->count();
        $groups = Groups::all()->count();

        return view('pages.dashboard.dashboard-' . $userRole, compact('cohort','cohorts', 'teachers', 'students', 'groups', 'userCohorts'));
    }
}
