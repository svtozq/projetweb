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
    public function index()
    {
        $students = User::all();
        $cohorts = Cohort::all();
        $studentsrole = UserSchool::where('role', 'student')->get();
        return view('pages.students.index', compact('students', 'studentsrole', 'cohorts'));
    }

    public function create(Request $request){
        $studentCreate = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'birth_date'=> $request->birth_date,
            'email'=> $request->email,
            'password'=> Hash::make('123456'),
        ]);

        UserSchool::create([
            'user_id' => $studentCreate->id,
            'school_id' => 1,
            'role'=> 'student',
        ]);

        $toEmail = $request->email;
        $messageEmail = "Votre Email : {$toEmail}";
        $subject = 'Espace Coding Factory';

        Mail::to($toEmail)->send(new PasswordMail($messageEmail, $subject));

        return redirect()->back();
    }

    public function update(Request $request){
        $validated = $request->validate([
            'current_email' => 'required|email|exists:users,email',
            'email' => 'required|email|unique:users,email,' . $request->current_email . ',email',
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'cohort_id' => 'nullable|exists:cohorts,id',
        ]);

        $student = User::where('email', $validated['current_email'])->first();

        $student->update([
            'email'=> $validated['email'],
            'last_name' => $validated['last_name'],
            'first_name' => $validated['first_name'],
        ]);

        if ($request->filled('birth_date')) {
            $student->birth_date = $request->birth_date;
        }

        if ($request->filled('cohort_id')) {
            CohortsSchools::create([
                'cohort_id' => $validated['cohort_id'],
                'user_id' => $student->id,
            ]);
        }

        return redirect()->route('student.index');
    }

    public function delete($studentId){
        $deletestudentU = User::find($studentId);
        $deletestudentU->delete();

        $deletestudentUS = UserSchool::find($studentId);
        $deletestudentUS->delete();

        return redirect()->back();
    }
}
