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
    public function index() {
        // Get the logged-in user
        $user = auth()->user();

        // Get cohorts of the logged-in user
        $userCohortsId = CohortsSchools::where('user_id', $user->id)->pluck('cohort_id');
        $userCohorts = Cohort::whereIn('id', $userCohortsId)->get();

        // Get all cohorts and Cohorts users
        $cohorts = Cohort::all();
        $cohortsSchools = CohortsSchools::all();
        return view('pages.cohorts.index',  compact('cohorts',  'cohortsSchools',  'userCohorts'));
    }

    public function show(Cohort $cohortId) {
        // Get students information
        $students = UserSchool::where('role', 'student')->pluck('id');
        $allStudents = User::whereIn('id', $students)->get();

        // Get usersId associated to this cohort
        $cohortUsersId = CohortsSchools::where('cohort_id', $cohortId->id)->pluck('user_id');

        // Get usersId associated to this cohort who are students
        $studentsId = UserSchool::whereIn('user_id', $cohortUsersId)
            ->where('role', 'student')
            ->pluck('user_id');

        // Get students associated to this cohort
        $cohortStudents = User::whereIn('id', $studentsId)->get();

        return view('pages.cohorts.show',  compact('cohortId', 'cohortStudents', 'allStudents'));
    }

    public function addStudent(Request $request, $cohortId) {
        // Get studentId
        $student_id = $request->input('student_id');

        // Verify if student already has an associated cohort
        $exists = CohortsSchools::where('user_id', $student_id)->exists();

        // If not create in DB a row for the student associated w this cohort
        if (!$exists) {
            CohortsSchools::create([
                'cohort_id' => $cohortId,
                'user_id' => $student_id,
            ]);
        }

        return redirect()->back();
    }

    public function deleteStudent($cohortId, $studentId) {
        // Delete row for the student associated w this cohort
        $cohortStudent = CohortsSchools::where('cohort_id', $cohortId)->where('user_id', $studentId);
        $cohortStudent->delete();

        return redirect()->back();
    }

    public function create(Request $request) {
        // Create a cohort w the sent requests
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

    public function delete($cohortId) {
        // Delete rows for students & teachers associated w this cohort
        $cohortUsers = CohortsSchools::where('cohort_id', $cohortId);
        $cohortUsers->delete();

        // Delete this cohort
        $cohort = Cohort::find($cohortId);
        $cohort->delete();

        return redirect()->back();
    }
}
