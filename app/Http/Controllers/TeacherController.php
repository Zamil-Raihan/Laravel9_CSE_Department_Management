<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Course;


class TeacherController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $teachers = Teacher::when($search, function ($query) use ($search) {
            $query->where('id', 'like', '%' . $search . '%')
                ->orWhere('t_name', 'like', '%' . $search . '%')
                ->orWhere('t_des', 'like', '%' . $search . '%')
                ->orWhere('t_email', 'like', '%' . $search . '%')
                ->orWhere('t_aq', 'like', '%' . $search . '%');
        })->orderBy('id', 'ASC')->get();
        return view('teacher.t_list', ['teachers' => $teachers, 'search' => $search]);
    }

    public function index_public(Request $request)
    {
        $search = $request->input('search');
        $teachers = Teacher::when($search, function ($query) use ($search) {
            $query->where('t_name', 'like', '%' . $search . '%');
        })->orderBy('t_des', 'ASC')->get();
        return view('teacher.t_list_s', ['teachers' => $teachers, 'search' => $search]);
    }

    public function create()
    {
        return view('teacher.create');
    }
    public function store(Request $request)
    {
        // Validation rules for the teacher creation form fields
        $validator = Validator::make($request->all(), [
            't_name' => 'required',
            't_des' => 'required',
            't_email' => 'required',
            't_phone' => 'required',
            't_aq' => 'required',
            't_image' => 'sometimes|image:jpg,jpeg,png,bmp',
        ]);

        if ($validator->passes()) {
            $teacher = new Teacher();

            $teacher->t_name = $request->t_name;
            $teacher->t_des = $request->t_des;
            $teacher->t_email = $request->t_email;
            $teacher->t_phone = $request->t_phone;
            $teacher->t_aq = $request->t_aq;

            $teacher->save();

            if ($request->hasFile('t_image')) {
                $ext = $request->t_image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->t_image->move(public_path() . '/uploads/teachers', $newFileName);
                $teacher->t_image = $newFileName;
                $teacher->save();
            }

            $request->session()->flash('success', 'Information Successfully Added...!');

            return redirect()->route('teacher.index');
        } else {
            return redirect()->route('teacher.create')->withErrors($validator)->withInput();
        }
    }


    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teacher.edit', ['teacher' => $teacher]);
    }

    public function update($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            't_name' => 'required',
            't_des' => 'required',
            't_email' => 'required',
            't_phone' => 'required',
            't_aq' => 'required',
            't_image' => 'sometimes|image:jpg,jpeg,png,bmp',
        ]);
        
        if ($validator->passes()) {
            $teacher = Teacher::find($id);
            $teacher->t_name = $request->t_name;
            $teacher->t_des = $request->t_des;
            $teacher->t_email = $request->t_email;
            $teacher->t_phone = $request->t_phone;
            $teacher->t_aq = $request->t_aq;
            $teacher->save();
            
            if ($request->t_image) {
                $oldImage = $teacher->t_image;
                $ext = $request->t_image->getClientOriginalExtension();
                $newFileName = time() . '.' . $ext;
                $request->t_image->move(public_path() . '/uploads/teachers', $newFileName);
                $teacher->t_image = $newFileName;
                $teacher->save();
                File::delete(public_path() . '/uploads/teachers/' . $oldImage);
            }
            
            $request->session()->flash('success', 'Information Successfully Edited...!');
            
            if (auth()->user()->role == 1) {
                return redirect()->route('teacher.index');
            } elseif (auth()->user()->role == 2) {
                return redirect()->route('teacher.home');
            }
        } else {
            return redirect()->route('teachers.edit', $id)->withErrors($validator)->withInput();
        }
    }
    
    public function destroy($id, Request $request)
    {
        $teacher = Teacher::findOrFail($id);
        File::delete(public_path() . '/uploads/teachers/' . $teacher->t_image);
        $teacher->delete();
        $request->session()->flash('success', 'Information deleted successfully...!');
        return redirect()->route('teacher.index');
    }



}
