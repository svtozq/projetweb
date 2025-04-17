<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = User::all();
        $teachersrole = UserSchool::where('role', 'teacher')->get();
        return view('pages.teachers.index', compact('teachers', 'teachersrole'));
    }

    public function create(Request $request){
        $teacherCreate = User::create([
            'last_name' => $request->last_name,
            'first_name' => $request->first_name,
            'email'=> $request->email,
            'password'=> Hash::make('123456'),
        ]);

        UserSchool::create([
            'user_id' => $teacherCreate->id,
            'school_id' => 1,
            'role'=> 'teacher',
        ]);

        return redirect()->back();
    }

    public function update(Request $request, $teacherId){
        $teacher = User::find($teacherId);

        if (!$teacher) {
            return response()->json(['error' => 'Teacher not found'], 404);
        }

        $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $teacherId,
        ]);

        $teacher->update([
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'email'=> $request->input('email'),
        ]);

        return redirect()->route('teacher.index');
    }

    public function delete($teacherId) {
        $deleteteacherU = User::find($teacherId);
        $deleteteacherU->delete();

        $deleteteacherUS = UserSchool::find($teacherId);
        $deleteteacherUS->delete();

        return redirect()->back();
    }
}
