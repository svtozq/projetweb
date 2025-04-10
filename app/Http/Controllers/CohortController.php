<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\UserSchool;
use App\Models\Student;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class CohortController extends Controller
{
    /**
     * Display all available cohorts
     * @return Factory|View|Application|object
     */
    public function index() {
        $cohorts = Cohort::all();
        return view('pages.cohorts.index',  compact('cohorts'));
    }


    /**
     * Display a specific cohort
     * @param Cohort $cohort
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohort) {
        $cohorts = Cohort::all();
        $students = Student::all();
        $myStudents = Student::query()->where('cohort_id', $cohorts->first->id)->get();
        return view('pages.cohorts.show',  compact('cohort', 'cohorts', 'students', 'myStudents'));
    }
}
