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

    public function create(Request $request){
        $cohortCreate = Cohort::create([
            'school_id' => 1,
            'name' => $request->name,
            'description' => $request->description,
            'students'=> $request->students,
            'start_date'=> $request->start_date,
            'end_date'=> $request->end_date,
        ]);

        return redirect()->back();
    }

    public function delete($cohortId){
        $cohort = Cohort::find($cohortId);
        $cohort->delete();

        return redirect()->back();
    }
}
