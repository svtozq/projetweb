<?php

namespace App\Http\Controllers;

use App\Models\UserSchool;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index()
    {
        $students = User::all();
        $studentsrole = UserSchool::where('role', 'student')->get();
        return view('pages.students.index', compact('students', 'studentsrole'));
    }

    public function create(Request $request){
        $studentCreate = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'birth_date'=> $request->birth_date,
            'email'=> $request->email,
            'password'=> Hash::make('123456'),
        ]);

        $studentCreate1 = UserSchool::create([
            'user_id' => $studentCreate->id,
            'school_id' => 1,
            'role'=> 'student',
        ]);

        return redirect()->back();
    }

    public function edit($studentId)
    {
        $student = User::find($studentId);
        return view('pages.students.student-', compact('student'));
    }

    public function update(Request $request, $studentId){
        $student = User::find($studentId);

        $student->update([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'birth_date'=> $request->birth_date,
            'email'=> $request->email,
        ]);
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
