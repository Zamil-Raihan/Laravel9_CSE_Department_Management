<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Notice;
use App\Models\News;


class CourseController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $courses = Course::when($search, function ($query) use ($search) {
            $query->where('t_name', 'like', '%' . $search . '%')
                ->orWhere('c_code', 'like', '%' . $search . '%')
                ->orWhere('c_title', 'like', '%' . $search . '%')
                ->orWhere('c_semester', 'like', '%' . $search . '%')
                ->orWhere('c_section', 'like', '%' . $search . '%');
        })->orderBy('id', 'ASC')->get();

        return view('course.c_list', ['courses' => $courses, 'search' => $search]);
    }

    public function index_public(Request $request)
    {
        $search = $request->input('search');
        $courses = Course::when($search, function ($query) use ($search) {
            $query->where('t_name', 'like', '%' . $search . '%')
                ->orWhere('c_code', 'like', '%' . $search . '%')
                ->orWhere('c_title', 'like', '%' . $search . '%')
                ->orWhere('c_semester', 'like', '%' . $search . '%')
                ->orWhere('c_section', 'like', '%' . $search . '%');
        })->orderBy('c_code', 'ASC')->get();

        // Get related news for each course
        foreach ($courses as $course) {
            $course->news = News::where('c_id', $course->id)->get();
        }
        return view('course.c_list_s', ['courses' => $courses, 'search' => $search]);
    }


    public function index_home(Request $request)
    {
        $randomCourses = Course::inRandomOrder()->limit(10)->get();
        $randomTeachers = Teacher::inRandomOrder()->limit(10)->get();
        $latestNotices = Notice::orderBy('created_at', 'desc')->limit(3)->get();

        return view('index', ['randomCourses' => $randomCourses,'randomTeachers' => $randomTeachers,'latestNotices' => $latestNotices]);
    }

    public function create(Request $request)
    {
        $t_id = $request->input('t_id');
        $t_name = $request->input('t_name');
        return view('course.c_create', compact('t_id', 't_name'));
    }

    public function store(Request $request)
    {
        // Validation rules for the course creation form fields
        $validator = Validator::make($request->all(), [
            't_id' => 'required',
            't_name' => 'required',
            'c_code' => 'required',
            'c_title' => 'required',
            'c_semester' => 'required',
            'c_section' => 'required',
            'c_out' => 'sometimes|mimes:pdf,docx,ppt,pptx',
            'c_mat' => 'sometimes|mimes:pdf,docx,ppt,pptx,zip,rar',
            'c_student' => 'sometimes',
        ]);

        if ($validator->passes()) {
            $course = new Course();

            // Assign form data to course object
            $course->t_id = $request->t_id;
            $course->t_name = $request->t_name;
            $course->c_code = $request->c_code;
            $course->c_title = $request->c_title;
            $course->c_semester = $request->c_semester;
            $course->c_section = $request->c_section;

            // Check if c_out file is provided
            if ($request->hasFile('c_out')) {
                $ext = $request->c_out->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->c_out->move(public_path() . '/uploads/courses', $newFileName);
                $course->c_out = $newFileName;
                $course->save();
            }

            // Check if c_mat file is provided
            if ($request->hasFile('c_mat')) {
                $ext = $request->c_mat->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->c_mat->move(public_path() . '/uploads/courses', $newFileName);
                $course->c_mat = $newFileName;
                $course->save();
            }

            // Check if c_student field is provided
            if ($request->filled('c_student')) {
                $course->c_student = $request->c_student;
            }

            $course->save();

            $request->session()->flash('success', 'Course Information Successfully Added...!');

            return redirect()->route('course.index');
        } else {
            return redirect()->route('course.create')->withErrors($validator)->withInput();
        }
    }

    public function view($id)
    {
        $course = Course::findOrFail($id);
        return view('course.c_view', ['course' => $course]);
    }
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        return view('course.c_edit', ['course' => $course]);
    }

    public function update(Request $request, $id)
    {
        // Validation rules for updating course information
        $validator = Validator::make($request->all(), [
            't_id' => 'required',
            't_name' => 'required',
            'c_code' => 'required',
            'c_title' => 'required',
            'c_semester' => 'required',
            'c_section' => 'required',
            'c_out' => 'sometimes|mimes:pdf,docx,ppt,pptx',
            'c_mat' => 'sometimes|mimes:pdf,docx,ppt,pptx,zip,rar',
            'c_student' => 'sometimes',
        ]);

        if ($validator->passes()) {
            $course = Course::findOrFail($id);

            $course->t_id = $request->t_id;
            $course->t_name = $request->t_name;
            $course->c_code = $request->c_code;
            $course->c_title = $request->c_title;
            $course->c_semester = $request->c_semester;
            $course->c_section = $request->c_section;
            $course->c_student = $request->c_student;

            $course->save();

            if ($request->hasFile('c_out')) {
                $ext = $request->file('c_out')->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->file('c_out')->move(public_path() . '/uploads/courses', $newFileName);
                $course->c_out = $newFileName;
            }
            if ($request->hasFile('c_mat')) {
                $ext = $request->file('c_mat')->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->file('c_mat')->move(public_path() . '/uploads/courses', $newFileName);
                $course->c_mat = $newFileName;
            }
            $course->save();
            
            $request->session()->flash('success', 'Course Information Successfully Updated...!');

            if (auth()->user()->role == 1) {
                return redirect()->route('course.index');
            } elseif (auth()->user()->role == 2) {
                return redirect()->route('teacher.home');
            }
        } else {
            return redirect()->route('course.edit', $id)->withErrors($validator)->withInput();
        }
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);
        if ($course) {
            if ($course->c_out) {
                File::delete('public/uploads/courses/' . $course->c_out);
            }
            if ($course->c_mat) {
                File::delete('public/uploads/courses/' . $course->c_mat);
            }
            $course->delete();
            session()->flash('success', 'Course deleted successfully.');
        } else {
            session()->flash('error', 'Course not found.');
        }
        return redirect()->route('course.index');
    }

}


