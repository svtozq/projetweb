<?php

namespace App\Http\Controllers;

use App\Mail\PasswordMail;
use App\Models\UserSchool;
use App\Models\User;
use App\Models\Cohort;
use App\Models\CohortsSchools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{
    public function index() {
        // Get objects
        $students = User::all();
        $cohorts = Cohort::all();
        $studentsrole = UserSchool::where('role', 'student')->get();

        return view('pages.students.index', compact('students', 'studentsrole', 'cohorts'));
    }

    public function create(Request $request) {
        // Create a student w the sent requests
        $studentCreate = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'birth_date'=> $request->birth_date,
            'email'=> $request->email,
            'password'=> Hash::make('123456'),
        ]);

        // Create associated row in users_school table
        UserSchool::create([
            'user_id' => $studentCreate->id,
            'school_id' => 1,
            'role'=> 'student',
        ]);

        // Send email
        $toEmail = $request->email;
        $messageEmail = "Votre Email : {$toEmail}";
        $subject = 'Espace Coding Factory';

        Mail::to($toEmail)->send(new PasswordMail($messageEmail, $subject));

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

        // Get student row by the current email input
        $student = User::where('email', $validated['current_email'])->first();

        // Update row
        $student->update([
            'email'=> $validated['email'],
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
        ]);

        // If birth date input is filled update birth_date row
        if ($request->filled('birth_date')) {
            $student->birth_date = $request->birth_date;
        }

        // If a cohort is select, then create in DB a row for the student associated w this cohort
//        if ($request->filled('cohort_id')) {
//            CohortsSchools::create([
//                'cohort_id' => $validated['cohort_id'],
//                'user_id' => $student->id,
//            ]);
//        }

        return redirect()->route('student.index');
    }

    public function delete($studentId) {
        // Find & delete the student
        $deletestudentU = User::find($studentId);
        $deletestudentU->delete();

        // Get & delete the row student associated w cohort
        $cohortStudent = CohortsSchools::where('user_id', $studentId);
        $cohortStudent->delete();

        // Find & delete associated row student in users_school table
        $deletestudentUS = UserSchool::find($studentId);
        $deletestudentUS->delete();

        return redirect()->back();
    }
}
