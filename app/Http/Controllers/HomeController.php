<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Notice;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){
        $randomCourses = Course::inRandomOrder()->limit(10)->get();
        $randomTeachers = Teacher::inRandomOrder()->limit(10)->get();
        $latestNotices = Notice::orderBy('created_at', 'desc')->limit(3)->get();

        return view('index', ['randomCourses' => $randomCourses,'randomTeachers' => $randomTeachers,'latestNotices' => $latestNotices]);
    }

    public function adminHome(){
        return view('admin-home');
    }

    public function teacherHome(){
        // Get the logged-in user's email
        $userEmail = Auth::user()->email;

        // Find the teacher with the matching email
        $teacher = Teacher::where('t_email', $userEmail)->first();

        // If no matching teacher is found, redirect with an error
        if (!$teacher) {
            return redirect()->route('home')->with('error', 'No teacher found with the given email.');
        }

        // Get the courses assigned to this teacher
        $courses = Course::where('t_id', $teacher->id)->get();

        return view('teacher-home', [
            'teacher' => $teacher,
            'courses' => $courses
        ]);
    }
    
}
