<?php

namespace App\Http\Controllers;


use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Parents;
use  App\Models\Student;
use App\Models\Subject;
use  App\Models\Grade;
class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {

            $parents = Parents::latest()->get();
            $teachers = Teacher::latest()->get();
            $students = Student::latest()->get();
            $subjects = Subject::latest()->get();
            $classes = Grade::latest()->get();

            return view('home', compact('parents','teachers','students','subjects','classes'));

        } elseif ($user->hasRole('Teacher')) {

            $teacher = Teacher::with(['user','subjects','classes','students'])->withCount('subjects','classes')->findOrFail($user->teacher->id);

            return view('home', compact('teacher'));

        } elseif ($user->hasRole('Parent')) {

            $parents = Parents::with(['children'])->withCount('children')->findOrFail($user->parent->id);

            return view('home', compact('parents'));

        } elseif ($user->hasRole('Student')) {

            $student = Student::with(['user','parent','class','attendances'])->findOrFail($user->student->id);

            return view('home', compact('student'));

        } else {
            return 'NO ROLE ASSIGNED YET!';
        }

    }

    public function changePassword(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
