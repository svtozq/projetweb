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
        $userRole = auth()->user()->school()->pivot->role;

        $user = auth()->user();

        $userCohortsId = CohortsSchools::where('user_id', $user->id)->pluck('cohort_id');
        $userCohorts = Cohort::whereIn('id', $userCohortsId)->get();

        $cohort = Cohort::all();
        $cohorts = Cohort::all()->count();
        $teachers = UserSchool::where('role', 'teacher')->count();
        $students = UserSchool::where('role', 'student')->count();
        $groups = Groups::all()->count();
        return view('pages.dashboard.dashboard-' . $userRole, compact('cohort','cohorts', 'teachers', 'students', 'groups', 'userCohorts'));
    }
}
