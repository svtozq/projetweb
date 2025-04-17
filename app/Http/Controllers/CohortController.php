<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\CohortsSchools;
use App\Models\UserSchool;
use App\Models\User;
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
        $user = auth()->user();

        $userCohortsId = CohortsSchools::where('user_id', $user->id)->pluck('cohort_id');
        $userCohorts = Cohort::whereIn('id', $userCohortsId)->get();

        $cohorts = Cohort::all();
        $cohortsSchools = CohortsSchools::all();
        return view('pages.cohorts.index',  compact('cohorts',  'cohortsSchools',  'userCohorts'));
    }


    /**
     * Display a specific cohort
     * @param Cohort $cohortId
     * @return Application|Factory|object|View
     */
    public function show(Cohort $cohortId) {
        $students = UserSchool::where('role', 'student')->pluck('id');

        $allStudents = User::whereIn('id', $students)->get();

        $cohortUsersId = CohortsSchools::where('cohort_id', $cohortId->id)->pluck('user_id');

        $studentsId = UserSchool::whereIn('user_id', $cohortUsersId)
            ->where('role', 'student')
            ->pluck('user_id');

        $cohortStudents = User::whereIn('id', $studentsId)->get();

        return view('pages.cohorts.show',  compact('cohortId', 'cohortStudents', 'allStudents'));
    }

    public function addStudent(Request $request, $cohortId) {
        $user_id = $request->input('user_id');

        $exists = CohortsSchools::where('cohort_id', $cohortId)
            ->where('user_id', $user_id)
            ->exists();

        if (!$exists) {
            CohortsSchools::create([
                'cohort_id' => $cohortId,
                'user_id' => $user_id,
            ]);
        }

        return redirect()->back();
    }

    public function deleteStudent($cohortId, $studentId) {
        $cohortStudent = CohortsSchools::where('cohort_id', $cohortId)
                                        ->where('user_id', $studentId);
        $cohortStudent->delete();

        return redirect()->back();
    }

    public function create(Request $request){
        Cohort::create([
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
