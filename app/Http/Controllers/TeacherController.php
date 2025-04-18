<?php

namespace App\Http\Controllers;

use App\Models\Cohort;
use App\Models\CohortsSchools;
use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index() {
        // Get objects
        $teachers = User::all();
        $cohorts = Cohort::all();
        $teachersrole = UserSchool::where('role', 'teacher')->get();

        return view('pages.teachers.index', compact('teachers', 'teachersrole', 'cohorts'));
    }

    public function create(Request $request) {
        // Create a teacher w the sent requests
        $teacherCreate = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email'=> $request->email,
            'password'=> Hash::make('123456'),
        ]);

        // Create associated row in users_school table
        UserSchool::create([
            'user_id' => $teacherCreate->id,
            'school_id' => 1,
            'role'=> 'teacher',
        ]);

        return redirect()->back();
    }

    public function update(Request $request) {
        // Verify inputs requirements
        $validated = $request->validate([
            'current_email' => 'required|email|exists:users,email',
            'email' => 'required|email|unique:users,email,' . $request->current_email . ',email',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'cohort_id' => 'nullable|exists:cohorts,id',
        ]);

        // Get teacher row by the current email input
        $teacher = User::where('email', $validated['current_email'])->first();

        // Update row
        $teacher->update([
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
            'email'=> $validated['email'],
        ]);

        // Verify if teacher is already associated w this cohort
        $exists = CohortsSchools::where('cohort_id',  $validated['cohort_id'])
            ->where('user_id', $teacher->id)
            ->exists();

        // If a cohort is select and is not associated, then create in DB a row for the teacher associated w this cohort
        if ($request->filled('cohort_id')) {
            if (!$exists) {
            CohortsSchools::create([
                'cohort_id' => $validated['cohort_id'],
                'user_id' => $teacher->id,
            ]);
            }
        }

        return redirect()->route('teacher.index');
    }

    public function delete($teacherId) {
        // Find & delete the teacher
        $deleteteacherU = User::find($teacherId);
        $deleteteacherU->delete();

        // Get & delete rows teacher associated w some cohorts
        $cohortTeacher = CohortsSchools::where('user_id', $teacherId);
        $cohortTeacher->delete();

        // Find & delete associated row teacher in users_school table
        $deleteteacherUS = UserSchool::find($teacherId);
        $deleteteacherUS->delete();

        return redirect()->back();
    }
}
