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

        $teacherCreate1 = UserSchool::create([
            'user_id' => $teacherCreate->id,
            'school_id' => 1,
            'role'=> 'teacher',
        ]);

        return redirect()->back();
    }

    public function delete($teacherId) {
        $deleteteacherU = User::find($teacherId);
        $deleteteacherU->delete();

        $teacher = $deleteteacherU->id;

        $deleteteacherUS = UserSchool::find($teacher);
        $deleteteacherUS->delete();

        return redirect()->back();
    }
}
